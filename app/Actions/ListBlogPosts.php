<?php

namespace App\Actions;

use Inertia\Inertia;
use Inertia\Response;
use Lorisleiva\Actions\Concerns\AsAction;

class ListBlogPosts
{
    use AsAction;

    public function asController(): Response
    {
        return Inertia::render('Blog/Index', [
            'posts' => GetPublishedBlogPosts::run(),
        ]);
    }
}
