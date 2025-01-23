<?php

namespace App\Data;

use App\Models\Testimonial;
use Spatie\LaravelData\Data;

class TestimonialData extends Data
{
    public function __construct(
        public int $id,
        public string $name,
        public string $text_nl,
        public string $text_en,
        public ?string $image_url,
        public string $image_full_url,
        public int $position,
    ) {
    }

    public static function fromModel(Testimonial $testimonial): self
    {
        return new self(
            id: $testimonial->id,
            name: $testimonial->name,
            text_nl: $testimonial->text_nl,
            text_en: $testimonial->text_en,
            image_url: $testimonial->image_url,
            image_full_url: $testimonial->image_full_url,
            position: $testimonial->position,
        );
    }
}
