<?php

namespace App\Actions;

use App\Models\BlogPost;
use Lorisleiva\Actions\Concerns\AsAction;

class CreateBlogPost
{
    use AsAction;

    public const PLACEHOLDER_FEATURED_IMAGE = 'images/use_case.svg';

    /**
     * @param  array{
     *     title_nl: string,
     *     title_en: string,
     *     content_nl: string,
     *     content_en: string,
     *     excerpt_nl?: string|null,
     *     excerpt_en?: string|null,
     *     slug?: string|null,
     *     featured_image?: string|null,
     * }  $attributes
     */
    public function handle(array $attributes): BlogPost
    {
        $slugSource = $attributes['slug'] ?? $attributes['title_nl'];

        return BlogPost::query()->create([
            'title_nl' => $attributes['title_nl'],
            'title_en' => $attributes['title_en'],
            'excerpt_nl' => $attributes['excerpt_nl'] ?? null,
            'excerpt_en' => $attributes['excerpt_en'] ?? null,
            'content_nl' => $attributes['content_nl'],
            'content_en' => $attributes['content_en'],
            'slug' => GenerateUniqueBlogPostSlug::run($slugSource),
            'featured_image' => $attributes['featured_image'] ?? self::PLACEHOLDER_FEATURED_IMAGE,
            'published_at' => null,
        ]);
    }
}
