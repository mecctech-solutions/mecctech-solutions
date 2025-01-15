<?php

namespace Tests\Feature\Actions;

use App\Actions\GetAllPortfolioItems;
use App\Models\PortfolioItem;
use Database\Factories\PortfolioItemFactory;
use Tests\TestCase;

class GetAllPortfolioItemsTest extends TestCase
{
    /** @test */
    public function it_should_return_all_portfolio_items()
    {
        self::assertEmpty(PortfolioItem::all());
        $portfolioItems = PortfolioItemFactory::new()->count(10)->create();
        self::assertEquals($portfolioItems->toArray(), GetAllPortfolioItems::run()->toArray());
    }

    /** @test */
    public function it_should_sort_on_position()
    {
        $portfolioItems = PortfolioItemFactory::new()->count(10)->create();

        $sortedPortfolioItems = $portfolioItems->sortBy(fn(PortfolioItem $portfolioItem) => $portfolioItem->position);

        self::assertEquals($sortedPortfolioItems->pluck('position'), GetAllPortfolioItems::run()->pluck('position'));
    }

    /** @test */
    public function it_should_return_portfolio_items_with_certain_tag()
    {
        // Given
        $firstTag = "Tag 1";
        $secondTag = "Tag 2";
        $portfolioItemsWithFirstTag = PortfolioItemFactory::new()
            ->count(5)
            ->withTags(['name' => $firstTag])
            ->create();

        PortfolioItemFactory::new()
            ->count(5)
            ->withTags(['name' => $secondTag])
            ->create();

        // When
        $result = GetAllPortfolioItems::run($firstTag);
        self::assertEquals($portfolioItemsWithFirstTag->toArray(), $result->toArray());
    }
}
