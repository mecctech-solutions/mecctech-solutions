<?php

namespace Tests\Feature\Controllers;


use Database\Factories\PortfolioItemFactory;
use Tests\TestCase;

class GetAllPortfolioItemsTest extends TestCase
{
    /** @test */
    public function it_should_return_all_portfolio_items()
    {
        PortfolioItemFactory::new()->count(10)->create();
        $response = $this->get(route("all-portfolio-items"));
        $portfolioItems = $response["payload"]['portfolio_items']["data"];
        self::assertCount(10, $portfolioItems);
    }

    /** @test */
    public function it_should_return_portfolio_items_with_tag_when_route_is_called()
    {
        $tag = "Tag 1";
        PortfolioItemFactory::new()
            ->count(5)
            ->withTags(['name' => $tag])
            ->create();

        $response = $this->get(route("all-portfolio-items")."?tag=".$tag);

        $portfolioItems = $response["payload"]['portfolio_items']["data"];

        self::assertNotEmpty($portfolioItems);

        foreach ($portfolioItems as $portfolioItem)
        {
            self::assertNotEmpty($portfolioItem);
        }
    }
}
