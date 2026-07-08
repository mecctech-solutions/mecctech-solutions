<?php

use App\Actions\CreateBlogPost;
use App\Data\CreateBlogPostData;
use App\Models\BlogPost;

function createBlogPost(array $attributes = []): BlogPost
{
    return CreateBlogPost::run(CreateBlogPostData::from(array_merge([
        'title_nl' => 'Nederlandse titel',
        'title_en' => 'English title',
        'content_nl' => '<p>Inhoud</p>',
        'content_en' => '<p>Content</p>',
    ], $attributes)));
}

it('creates a blog post as a draft', function () {
    $blogPost = createBlogPost([
        'title_nl' => 'Nederlandse titel',
        'title_en' => 'English title',
    ]);

    expect($blogPost)->toBeInstanceOf(BlogPost::class)
        ->and($blogPost->published_at)->toBeNull()
        ->and($blogPost->title_nl)->toBe('Nederlandse titel')
        ->and($blogPost->title_en)->toBe('English title');
});

it('generates a slug from the dutch title when none is provided', function () {
    $blogPost = createBlogPost(['title_nl' => 'Mijn Eerste Post']);

    expect($blogPost->slug)->toBe('mijn-eerste-post');
});

it('appends a suffix when the generated slug already exists', function () {
    BlogPost::factory()->create(['slug' => 'mijn-eerste-post']);

    $blogPost = createBlogPost(['title_nl' => 'Mijn Eerste Post']);

    expect($blogPost->slug)->toBe('mijn-eerste-post-2');
});

it('uses the provided slug when given', function () {
    $blogPost = createBlogPost(['slug' => 'custom-slug']);

    expect($blogPost->slug)->toBe('custom-slug');
});

it('falls back to the placeholder featured image when none is provided', function () {
    $blogPost = createBlogPost();

    expect($blogPost->featured_image)->toBe(CreateBlogPost::PLACEHOLDER_FEATURED_IMAGE);
});

it('stores the provided featured image', function () {
    $blogPost = createBlogPost(['featured_image' => 'blog/hero.jpg']);

    expect($blogPost->featured_image)->toBe('blog/hero.jpg');
});

it('sanitizes dangerous html in the content', function () {
    $blogPost = createBlogPost([
        'content_nl' => '<p>Veilig</p><script>alert("xss")</script>',
        'content_en' => '<p>Safe</p><a href="#" onclick="alert(1)">link</a>',
    ]);

    expect($blogPost->content_nl)->not->toContain('<script>')
        ->and($blogPost->content_nl)->toContain('Veilig')
        ->and($blogPost->content_en)->not->toContain('onclick');
});
