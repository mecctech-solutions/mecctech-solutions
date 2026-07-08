<?php

namespace App\Data;

use Spatie\LaravelData\Data;

class CreateBlogPostData extends Data
{
    public function __construct(
        public string $title_nl,
        public string $title_en,
        public string $content_nl,
        public string $content_en,
        public ?string $excerpt_nl = null,
        public ?string $excerpt_en = null,
        public ?string $slug = null,
        public ?string $featured_image = null,
    ) {}
}
