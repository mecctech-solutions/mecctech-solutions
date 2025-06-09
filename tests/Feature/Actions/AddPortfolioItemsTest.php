<?php

use App\Actions\AddPortfolioItems;
use App\Data\PortfolioItemData;
use App\Models\BulletPoint;
use App\Models\Image;
use App\Models\PortfolioItem;
use App\Models\Tag;
use Database\Factories\PortfolioItemFactory;

it('should add portfolio items with relations', function () {
    // Given
    $bulletPoints = BulletPoint::factory()->count(1)->make();
    $images = Image::factory()->count(1)->make();
    $tags = Tag::factory()->count(1)->make(['visible' => true]);
    $n = 0;
    $portfolioItems = PortfolioItemFactory::new()
        ->count(20)
        ->make()
        ->map(function ($portfolioItem) use ($bulletPoints, $images, $tags, &$n) {
            $portfolioItem['bullet_points'] = $bulletPoints->toArray();
            $portfolioItem['images'] = $images->toArray();
            $portfolioItem['tags'] = $tags->toArray();
            $portfolioItem['position'] = $n + 1;
            $n++;

            return $portfolioItem;
        });

    // When
    AddPortfolioItems::run(PortfolioItemData::collect($portfolioItems));

    // Then
    $expectedPortfolioItems = $portfolioItems;

    $actualPortfolioItems = PortfolioItem::query()
        ->with('tags', 'images', 'bulletPoints', 'caseStudy')
        ->get();

    // Then
    self::assertEquals($this->normalizeDataForComparison($expectedPortfolioItems->toArray(), ['portfolio_item_id', 'position']), $this->normalizeDataForComparison($actualPortfolioItems->toArray(), ['portfolio_item_id', 'position']));
});
