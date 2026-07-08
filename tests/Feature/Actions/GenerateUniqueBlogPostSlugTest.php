<?php

use App\Actions\GenerateUniqueBlogPostSlug;
use App\Models\BlogPost;

it('slugifies the source string', function () {
    expect(GenerateUniqueBlogPostSlug::run('Mijn Mooie Titel'))->toBe('mijn-mooie-titel');
});

it('appends an incrementing suffix on collisions', function () {
    BlogPost::factory()->create(['slug' => 'titel']);
    BlogPost::factory()->create(['slug' => 'titel-2']);

    expect(GenerateUniqueBlogPostSlug::run('Titel'))->toBe('titel-3');
});

it('ignores the given post when checking uniqueness', function () {
    $blogPost = BlogPost::factory()->create(['slug' => 'titel']);

    expect(GenerateUniqueBlogPostSlug::run('Titel', $blogPost->id))->toBe('titel');
});
