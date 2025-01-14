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
}
