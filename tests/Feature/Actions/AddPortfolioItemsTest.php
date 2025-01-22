<?php

namespace Tests\Feature\Actions;

use App\Actions\AddPortfolioItems;
use App\Data\PortfolioItemData;
use App\Models\BulletPoint;
use App\Models\Image;
use App\Models\PortfolioItem;
use App\Models\Tag;
use Database\Factories\PortfolioItemFactory;
use Tests\TestCase;

class AddPortfolioItemsTest extends TestCase
{
    /** @test */
    public function it_should_add_portfolio_items_with_relations()
    {
        // Given
        $bulletPoints = BulletPoint::factory()->count(3)->make();
        $images = Image::factory()->count(3)->make();
        $tags = Tag::factory()->count(3)->make(['visible' => true]);
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
        $portfolioItems = PortfolioItemData::collect($portfolioItems);

        // When
        AddPortfolioItems::run($portfolioItems);

        // Then
        $expectedPortfolioItems = $portfolioItems;

        $actualPortfolioItems = PortfolioItemData::collect(PortfolioItem::query()
            ->with('tags', 'images', 'bulletPoints')
            ->get());

        // Then
        self::assertEquals($expectedPortfolioItems, $actualPortfolioItems);
    }
}
