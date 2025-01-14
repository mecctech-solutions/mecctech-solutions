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
}
