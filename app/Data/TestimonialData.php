<?php

namespace App\Data;

use App\Models\Testimonial;
use Spatie\LaravelData\Data;

class TestimonialData extends Data
{
    public function __construct(
        public int $id,
        public string $name,
        public ?string $job_title_en,
        public string $job_title_nl,
        public string $text_nl,
        public string $text_en,
        public ?string $image_url,
        public string $image_full_url,
        public int $position,
        public ?string $client_name,
    ) {}

    public static function fromModel(Testimonial $testimonial): self
    {
        return new self(
            id: $testimonial->id,
            name: $testimonial->name,
            job_title_en: $testimonial->job_title_en,
            job_title_nl: $testimonial->job_title_nl,
            text_nl: $testimonial->text_nl,
            text_en: $testimonial->text_en,
            image_url: $testimonial->image_url,
            image_full_url: $testimonial->image_full_url,
            position: $testimonial->position,
            /** @phpstan-ignore-next-line */
            client_name: $testimonial->client?->name,
        );
    }
}
