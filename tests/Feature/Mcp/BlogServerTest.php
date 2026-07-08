<?php

use App\Models\BlogPost;
use App\Models\User;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

function callMcpTool(TestCase $test, string $name, array $arguments = [])
{
    return $test->postJson('mcp/blog', [
        'jsonrpc' => '2.0',
        'id' => 2,
        'method' => 'tools/call',
        'params' => [
            'name' => $name,
            'arguments' => $arguments,
        ],
    ]);
}

/**
 * @return array<string, mixed>
 */
function decodeToolResult($response): array
{
    return json_decode((string) $response->json('result.content.0.text'), true);
}

it('rejects unauthenticated requests', function () {
    $response = $this->postJson('mcp/blog', [
        'jsonrpc' => '2.0',
        'id' => 1,
        'method' => 'initialize',
        'params' => [],
    ]);

    $response->assertUnauthorized();
});

it('creates a blog post through the create tool', function () {
    Sanctum::actingAs(User::factory()->create(), ['blog:write', 'blog:read']);

    $response = callMcpTool($this, 'create-blog-post', [
        'title_nl' => 'Nieuwe post',
        'title_en' => 'New post',
        'content_nl' => '<p>Inhoud</p>',
        'content_en' => '<p>Content</p>',
    ]);

    $response->assertOk();
    expect($response->json('result.isError'))->toBeFalse();

    $data = decodeToolResult($response);

    expect($data['title_nl'])->toBe('Nieuwe post')
        ->and($data['published_at'])->toBeNull();

    $this->assertDatabaseHas(BlogPost::class, [
        'title_nl' => 'Nieuwe post',
        'title_en' => 'New post',
        'published_at' => null,
    ]);
});

it('lists blog posts including drafts through the list tool', function () {
    Sanctum::actingAs(User::factory()->create(), ['blog:read']);
    BlogPost::factory()->create();
    BlogPost::factory()->draft()->create();

    $response = callMcpTool($this, 'list-blog-posts', ['status' => 'all']);

    $response->assertOk();
    $data = decodeToolResult($response);

    expect($data['total'])->toBe(2);
});

it('publishes a blog post through the publish tool', function () {
    Sanctum::actingAs(User::factory()->create(), ['blog:write']);
    $blogPost = BlogPost::factory()->draft()->create();

    $response = callMcpTool($this, 'publish-blog-post', ['id' => $blogPost->id]);

    $response->assertOk();
    expect($response->json('result.isError'))->toBeFalse()
        ->and($blogPost->refresh()->isPublished())->toBeTrue();
});

it('does not expose a delete tool', function () {
    Sanctum::actingAs(User::factory()->create(), ['blog:write', 'blog:read']);

    $response = $this->postJson('mcp/blog', [
        'jsonrpc' => '2.0',
        'id' => 3,
        'method' => 'tools/list',
    ]);

    $response->assertOk();

    $toolNames = collect($response->json('result.tools'))->pluck('name');

    expect($toolNames)->toContain(
        'create-blog-post',
        'update-blog-post',
        'get-blog-post',
        'list-blog-posts',
        'publish-blog-post',
        'unpublish-blog-post',
    )->and($toolNames)->not->toContain('delete-blog-post');
});

it('blocks write tools when the token lacks the blog:write ability', function () {
    Sanctum::actingAs(User::factory()->create(), ['blog:read']);

    $response = callMcpTool($this, 'create-blog-post', [
        'title_nl' => 'Nieuwe post',
        'title_en' => 'New post',
        'content_nl' => '<p>Inhoud</p>',
        'content_en' => '<p>Content</p>',
    ]);

    $response->assertOk();
    expect($response->json('result.isError'))->toBeTrue();

    $this->assertDatabaseMissing(BlogPost::class, ['title_nl' => 'Nieuwe post']);
});

it('returns a validation error when required fields are missing', function () {
    Sanctum::actingAs(User::factory()->create(), ['blog:write', 'blog:read']);

    $response = callMcpTool($this, 'create-blog-post', [
        'title_nl' => 'Alleen NL titel',
    ]);

    $response->assertOk();
    expect($response->json('result.isError'))->toBeTrue();
});
