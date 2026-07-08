<?php

use App\Actions\GetAllBlogPosts;
use App\Models\BlogPost;

it('returns published and draft posts when status is all', function () {
    BlogPost::factory()->create();
    BlogPost::factory()->draft()->create();

    $paginator = GetAllBlogPosts::run(status: 'all');

    expect($paginator->total())->toBe(2);
});

it('returns only published posts when status is published', function () {
    BlogPost::factory()->create();
    BlogPost::factory()->draft()->create();
    BlogPost::factory()->scheduled()->create();

    $paginator = GetAllBlogPosts::run(status: 'published');

    expect($paginator->total())->toBe(1);
});

it('treats scheduled posts as drafts', function () {
    BlogPost::factory()->create();
    BlogPost::factory()->draft()->create();
    BlogPost::factory()->scheduled()->create();

    $paginator = GetAllBlogPosts::run(status: 'draft');

    expect($paginator->total())->toBe(2);
});

it('filters by search term across both titles', function () {
    BlogPost::factory()->create(['title_nl' => 'Laravel tips', 'title_en' => 'Something else']);
    BlogPost::factory()->create(['title_nl' => 'Iets anders', 'title_en' => 'Laravel tricks']);
    BlogPost::factory()->create(['title_nl' => 'Niet relevant', 'title_en' => 'Not relevant']);

    $paginator = GetAllBlogPosts::run(search: 'Laravel');

    expect($paginator->total())->toBe(2);
});

it('paginates the results', function () {
    BlogPost::factory()->count(5)->create();

    $paginator = GetAllBlogPosts::run(perPage: 2, page: 1);

    expect($paginator->total())->toBe(5)
        ->and($paginator->perPage())->toBe(2)
        ->and($paginator->lastPage())->toBe(3)
        ->and($paginator->items())->toHaveCount(2);
});
