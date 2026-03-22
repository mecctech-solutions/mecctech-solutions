<?php

namespace App\Data;

use App\Actions\DetermineFullFileUrl;
use App\Models\BlogPost;
use Spatie\LaravelData\Data;

class BlogPostData extends Data
{
    public function __construct(
        public int $id,
        public string $title_nl,
        public string $title_en,
        public string $slug,
        public ?string $excerpt_nl,
        public ?string $excerpt_en,
        public string $content_nl,
        public string $content_en,
        public string $featured_image,
        public string $featured_image_full_url,
        public ?string $published_at,
    ) {}

    public static function fromModel(BlogPost $blogPost): self
    {
        return new self(
            id: $blogPost->id,
            title_nl: $blogPost->title_nl,
            title_en: $blogPost->title_en,
            slug: $blogPost->slug,
            excerpt_nl: $blogPost->excerpt_nl,
            excerpt_en: $blogPost->excerpt_en,
            content_nl: $blogPost->content_nl,
            content_en: $blogPost->content_en,
            featured_image: $blogPost->featured_image,
            featured_image_full_url: DetermineFullFileUrl::run($blogPost->featured_image),
            published_at: $blogPost->published_at?->toIso8601String(),
        );
    }
}
