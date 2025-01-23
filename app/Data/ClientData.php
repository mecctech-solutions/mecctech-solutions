<?php

namespace App\Data;

use App\Models\Client;
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
        /** @var TestimonialData[] */
        public ?DataCollection $testimonials = null,
    ) {
    }

    public static function fromModel(Client $client): self
    {
        return new self(
            id: $client->id,
            name: $client->name,
            website_url: $client->website_url,
            logo_url: $client->logo_url,
            logo_full_url: $client->logo_full_url,
            position: $client->position,
            testimonials: $client->testimonials ? TestimonialData::collection($client->testimonials) : null,
        );
    }
} 