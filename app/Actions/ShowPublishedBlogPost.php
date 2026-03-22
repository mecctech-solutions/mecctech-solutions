<?php

namespace App\Actions;

use App\Data\BlogPostData;
use App\Models\BlogPost;
use Inertia\Inertia;
use Inertia\Response;
use Lorisleiva\Actions\Concerns\AsAction;

class ShowPublishedBlogPost
{
    use AsAction;

    public function asController(BlogPost $blogPost): Response
    {
        if (! $blogPost->isPublished()) {
            abort(404);
        }

        return Inertia::render('Blog/Show', [
            'post' => BlogPostData::fromModel($blogPost)->toArray(),
        ]);
    }
}
