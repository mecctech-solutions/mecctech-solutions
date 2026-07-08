<?php

namespace App\Actions;

use App\Data\UpdateBlogPostData;
use App\Models\BlogPost;
use Lorisleiva\Actions\Concerns\AsAction;

class UpdateBlogPost
{
    use AsAction;

    /**
     * Applies a partial (patch) update: only the fields present on the data
     * object are changed, the rest are left untouched.
     */
    public function handle(BlogPost $blogPost, UpdateBlogPostData $data): BlogPost
    {
        $attributes = $data->toArray();

        if (array_key_exists('slug', $attributes)) {
            $attributes['slug'] = GenerateUniqueBlogPostSlug::run($attributes['slug'], $blogPost->id);
        }

        $blogPost->fill($attributes)->save();

        return $blogPost->refresh();
    }
}
