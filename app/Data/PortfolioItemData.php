<?php

namespace App\Data;

use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;

class PortfolioItemData extends Data
{
    public function __construct(
        public string $title_en,
        public string $title_nl,
        public string $description_en,
        public string $description_nl,
        public string $main_image_url,
        public string $website_url,
        public int $position,

        #[DataCollectionOf(BulletPointData::class)]
        public ?DataCollection $bullet_points,

        #[DataCollectionOf(ImageData::class)]
        public ?DataCollection $images,

        #[DataCollectionOf(TagData::class)]
        public ?DataCollection $tags,
    )
    {}
}