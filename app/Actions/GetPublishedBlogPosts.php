<?php

namespace App\Actions;

use App\Data\BlogPostData;
use App\Models\BlogPost;
use Illuminate\Support\Collection;
use Lorisleiva\Actions\Concerns\AsAction;

class GetPublishedBlogPosts
{
    use AsAction;

    /**
     * @return Collection<int, BlogPostData>
     */
    public function handle(): Collection
    {
        return BlogPost::query()
            ->published()
            ->orderByDesc('published_at')
            ->get()
            ->map(fn (BlogPost $blogPost) => BlogPostData::fromModel($blogPost));
    }
}
