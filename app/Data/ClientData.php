<?php

namespace App\Data;

use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;

class ClientData extends Data
{
    public function __construct(
        public int $id,
        public string $name,
        public string $website_url,
        public string $logo_url,
        public string $logo_full_url,
        public int $position,

        #[DataCollectionOf(TestimonialData::class)]
        public ?DataCollection $testimonials,
    ) {
    }
}
