<?php

use App\Actions\PublishBlogPost;
use App\Models\BlogPost;
use Illuminate\Support\Carbon;

it('publishes a draft immediately when no date is given', function () {
    Carbon::setTestNow('2026-07-08 12:00:00');
    $blogPost = BlogPost::factory()->draft()->create();

    PublishBlogPost::run($blogPost);

    expect($blogPost->refresh()->published_at->toDateTimeString())->toBe('2026-07-08 12:00:00')
        ->and($blogPost->isPublished())->toBeTrue();
});

it('schedules publication for a future date', function () {
    Carbon::setTestNow('2026-07-08 12:00:00');
    $blogPost = BlogPost::factory()->draft()->create();
    $future = Carbon::parse('2026-07-15 09:00:00');

    PublishBlogPost::run($blogPost, $future);

    $blogPost->refresh();

    expect($blogPost->published_at->toDateTimeString())->toBe('2026-07-15 09:00:00')
        ->and($blogPost->isPublished())->toBeFalse();
});
