<?php

use App\Actions\UnpublishBlogPost;
use App\Models\BlogPost;

it('reverts a published post to a draft', function () {
    $blogPost = BlogPost::factory()->create(['published_at' => now()->subDay()]);

    UnpublishBlogPost::run($blogPost);

    $blogPost->refresh();

    expect($blogPost->published_at)->toBeNull()
        ->and($blogPost->isPublished())->toBeFalse();
});
