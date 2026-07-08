<?php

namespace App\Data;

use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;

class UpdateBlogPostData extends Data
{
    public function __construct(
        public string|Optional $title_nl,
        public string|Optional $title_en,
        public string|Optional $content_nl,
        public string|Optional $content_en,
        public string|null|Optional $excerpt_nl,
        public string|null|Optional $excerpt_en,
        public string|Optional $slug,
        public string|Optional $featured_image,
    ) {}
}
