<?php

use Database\Factories\PortfolioItemFactory;
use Tests\TestCase;

class PortfolioItemFactoryTest extends TestCase
{
    /** @test */
    public function it_should_create_a_portfolio_item()
    {
        // Given
        $portfolioItem = PortfolioItemFactory::new()->create();

        // Then
        self::assertDatabaseHas("portfolio_items", $portfolioItem->getAttributes());
    }

    /** @test */
    public function it_should_create_a_portfolio_item_with_tags()
    {
        // Given
        $portfolioItem = PortfolioItemFactory::new()->create();

        // Then
        self::assertDatabaseHas("portfolio_items", $portfolioItem->getAttributes());
        self::assertCount(3, $portfolioItem->tags);
    }

    /** @test */
    public function it_should_create_a_portfolio_item_with_images()
    {
        // Given
        $portfolioItem = PortfolioItemFactory::new()->create();

        // Then
        self::assertDatabaseHas("portfolio_items", $portfolioItem->getAttributes());
        self::assertCount(3, $portfolioItem->images);
    }

    /** @test */
    public function it_should_create_a_portfolio_item_with_bullet_points()
    {
        // Given
        $portfolioItem = PortfolioItemFactory::new()->create();

        // Then
        self::assertDatabaseHas("portfolio_items", $portfolioItem->getAttributes());
        self::assertCount(3, $portfolioItem->bulletPoints);
    }
}
