<?php

use App\Models\BlogPost;
use Inertia\Testing\AssertableInertia;

uses(\Illuminate\Foundation\Testing\RefreshDatabase::class);

test('blog index lists published posts with image url', function () {
    $published = BlogPost::factory()->create([
        'title_en' => 'Visible Post',
        'slug' => 'visible-post',
        'published_at' => now()->subHour(),
    ]);
    BlogPost::factory()->draft()->create([
        'title_en' => 'Draft Post',
    ]);

    $response = $this->get(route('blog.index'));

    $response->assertOk();
    $response->assertInertia(function (AssertableInertia $page) use ($published) {
        $page->component('Blog/Index')
            ->has('posts', 1)
            ->has('posts.0', fn (AssertableInertia $post) => $post
                ->where('id', $published->id)
                ->where('slug', 'visible-post')
                ->where('title_en', 'Visible Post')
                ->has('featured_image_full_url')
                ->etc()
            );
    });
});

test('blog index shows empty list when no published posts', function () {
    BlogPost::factory()->draft()->count(2)->create();

    $this->get(route('blog.index'))
        ->assertOk()
        ->assertInertia(fn (AssertableInertia $page) => $page
            ->component('Blog/Index')
            ->has('posts', 0));
});

test('blog index excludes posts scheduled for the future', function () {
    BlogPost::factory()->scheduled()->create();

    $this->get(route('blog.index'))
        ->assertOk()
        ->assertInertia(fn (AssertableInertia $page) => $page
            ->component('Blog/Index')
            ->has('posts', 0));
});

test('blog show displays published post', function () {
    $post = BlogPost::factory()->create([
        'title_en' => 'Hello World',
        'slug' => 'hello-world',
        'published_at' => now()->subDay(),
    ]);

    $this->get(route('blog.show', $post))
        ->assertOk()
        ->assertInertia(function (AssertableInertia $page) use ($post) {
            $page->component('Blog/Show')
                ->has('post', fn (AssertableInertia $p) => $p
                    ->where('id', $post->id)
                    ->where('slug', 'hello-world')
                    ->where('title_en', 'Hello World')
                    ->has('featured_image_full_url')
                    ->etc()
                );
        });
});

test('blog show returns 404 for draft post', function () {
    $post = BlogPost::factory()->draft()->create();

    $this->get(route('blog.show', $post))
        ->assertNotFound();
});

test('blog show returns 404 for future scheduled post', function () {
    $post = BlogPost::factory()->scheduled()->create();

    $this->get(route('blog.show', $post))
        ->assertNotFound();
});

test('blog show returns 404 for non existent slug', function () {
    $this->get(route('blog.show', ['blogPost' => 'missing-slug']))
        ->assertNotFound();
});
