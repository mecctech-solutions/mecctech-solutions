<?php

namespace App\Data;

use App\Actions\DetermineFullFileUrl;
use App\Models\PortfolioItem;
use Spatie\LaravelData\Attributes\Computed;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;

/**
 * @property string $main_image_full_url
 * @property-read ?DataCollection<int, BulletPointData> $bullet_points
 * @property-read ?DataCollection<int, ImageData> $images
 * @property-read ?DataCollection<int, TagData> $tags
 */
class PortfolioItemData extends Data
{
    #[Computed]
    public string $main_image_full_url;

    public function __construct(
        public ?int $id,
        public string $title_en,
        public string $title_nl,
        public ?string $description_en,
        public ?string $description_nl,
        public string $main_image_url,
        public ?string $website_url,
        public int $position,
        public bool $visible,
        public bool $has_case_study,
        public ?string $case_study_slug,

        #[DataCollectionOf(BulletPointData::class)]
        public ?DataCollection $bullet_points,

        #[DataCollectionOf(ImageData::class)]
        public ?DataCollection $images,

        #[DataCollectionOf(TagData::class)]
        public ?DataCollection $tags,
    ) {
        $this->main_image_full_url = DetermineFullFileUrl::run($this->main_image_url);
    }

    public static function fromModel(PortfolioItem $portfolioItem): self
    {
        return new self(
            id: $portfolioItem->id,
            title_en: $portfolioItem->title_en,
            title_nl: $portfolioItem->title_nl,
            description_en: $portfolioItem->description_en,
            description_nl: $portfolioItem->description_nl,
            main_image_url: $portfolioItem->main_image_url,
            website_url: $portfolioItem->website_url,
            position: $portfolioItem->position,
            visible: $portfolioItem->visible,
            has_case_study: $portfolioItem->hasCaseStudy(),
            case_study_slug: $portfolioItem->caseStudy?->slug,
            bullet_points: empty($portfolioItem->bulletPoints) ? null : BulletPointData::collect($portfolioItem->bulletPoints, DataCollection::class),
            images: empty($portfolioItem->images) ? null : ImageData::collect($portfolioItem->images, DataCollection::class),
            tags: empty($portfolioItem->tags) ? null : TagData::collect($portfolioItem->tags, DataCollection::class),
        );
    }
}
