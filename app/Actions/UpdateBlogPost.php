<?php

namespace App\Actions;

use App\Models\BlogPost;
use Lorisleiva\Actions\Concerns\AsAction;

class UpdateBlogPost
{
    use AsAction;

    /**
     * Applies a partial (patch) update: only the provided keys are changed.
     *
     * @param  array{
     *     title_nl?: string,
     *     title_en?: string,
     *     content_nl?: string,
     *     content_en?: string,
     *     excerpt_nl?: string|null,
     *     excerpt_en?: string|null,
     *     slug?: string,
     *     featured_image?: string,
     * }  $attributes
     */
    public function handle(BlogPost $blogPost, array $attributes): BlogPost
    {
        if (array_key_exists('slug', $attributes)) {
            $attributes['slug'] = GenerateUniqueBlogPostSlug::run($attributes['slug'], $blogPost->id);
        }

        $blogPost->fill($attributes)->save();

        return $blogPost->refresh();
    }
}
