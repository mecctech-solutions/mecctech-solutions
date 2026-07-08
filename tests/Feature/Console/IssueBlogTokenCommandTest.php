<?php

use App\Models\User;
use Laravel\Sanctum\PersonalAccessToken;

it('creates the agent user and issues a token with blog abilities', function () {
    $this->artisan('mcp:issue-blog-token')
        ->assertSuccessful();

    $user = User::where('email', 'agents@mecctech-solutions.nl')->first();

    expect($user)->not->toBeNull()
        ->and($user->name)->toBe('MCP Agent');

    $token = PersonalAccessToken::where('tokenable_id', $user->id)->first();

    expect($token->name)->toBe('claude-code')
        ->and($token->abilities)->toContain('blog:read', 'blog:write');
});

it('reuses an existing user instead of creating a duplicate', function () {
    $existing = User::factory()->create(['email' => 'agents@mecctech-solutions.nl']);

    $this->artisan('mcp:issue-blog-token')->assertSuccessful();

    expect(User::where('email', 'agents@mecctech-solutions.nl')->count())->toBe(1)
        ->and(PersonalAccessToken::where('tokenable_id', $existing->id)->count())->toBe(1);
});

it('accepts a custom email, name and token label', function () {
    $this->artisan('mcp:issue-blog-token', [
        '--email' => 'bot@example.com',
        '--name' => 'Custom Bot',
        '--token-name' => 'ci-runner',
    ])->assertSuccessful();

    $user = User::where('email', 'bot@example.com')->first();

    expect($user)->not->toBeNull()
        ->and($user->name)->toBe('Custom Bot');

    expect(PersonalAccessToken::where('tokenable_id', $user->id)->first()->name)->toBe('ci-runner');
});
