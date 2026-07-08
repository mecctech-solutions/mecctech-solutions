<?php

use App\Actions\UpdateBlogPost;
use App\Data\UpdateBlogPostData;
use App\Models\BlogPost;

it('only updates the fields that are provided', function () {
    $blogPost = BlogPost::factory()->create([
        'title_nl' => 'Origineel NL',
        'title_en' => 'Original EN',
        'content_nl' => '<p>Origineel</p>',
    ]);

    UpdateBlogPost::run($blogPost, UpdateBlogPostData::from([
        'title_nl' => 'Aangepast NL',
    ]));

    $blogPost->refresh();

    expect($blogPost->title_nl)->toBe('Aangepast NL')
        ->and($blogPost->title_en)->toBe('Original EN')
        ->and($blogPost->content_nl)->toBe('<p>Origineel</p>');
});

it('can clear a nullable excerpt', function () {
    $blogPost = BlogPost::factory()->create(['excerpt_nl' => 'Bestaand excerpt']);

    UpdateBlogPost::run($blogPost, UpdateBlogPostData::from(['excerpt_nl' => null]));

    expect($blogPost->refresh()->excerpt_nl)->toBeNull();
});

it('regenerates a unique slug when the slug is updated', function () {
    BlogPost::factory()->create(['slug' => 'bestaande-slug']);
    $blogPost = BlogPost::factory()->create(['slug' => 'oude-slug']);

    UpdateBlogPost::run($blogPost, UpdateBlogPostData::from(['slug' => 'Bestaande Slug']));

    expect($blogPost->refresh()->slug)->toBe('bestaande-slug-2');
});

it('keeps its own slug when updating with an unchanged slug', function () {
    $blogPost = BlogPost::factory()->create(['slug' => 'mijn-slug']);

    UpdateBlogPost::run($blogPost, UpdateBlogPostData::from(['slug' => 'mijn-slug']));

    expect($blogPost->refresh()->slug)->toBe('mijn-slug');
});

it('sanitizes dangerous html when updating content', function () {
    $blogPost = BlogPost::factory()->create();

    UpdateBlogPost::run($blogPost, UpdateBlogPostData::from([
        'content_nl' => '<p>Veilig</p><script>alert("xss")</script>',
    ]));

    expect($blogPost->refresh()->content_nl)->not->toContain('<script>')
        ->and($blogPost->content_nl)->toContain('Veilig');
});
