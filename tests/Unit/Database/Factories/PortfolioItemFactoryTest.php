<?php

use Database\Factories\PortfolioItemFactory;

it('should create a portfolio item', function () {
    // Given
    $portfolioItem = PortfolioItemFactory::new()->create();

    // Then
    self::assertDatabaseHas('portfolio_items', $portfolioItem->getAttributes());
});
it('should create a portfolio item with tags', function () {
    // Given
    $portfolioItem = PortfolioItemFactory::new()->create();

    // Then
    self::assertDatabaseHas('portfolio_items', $portfolioItem->getAttributes());
    self::assertCount(3, $portfolioItem->tags);
});
it('should create a portfolio item with images', function () {
    // Given
    $portfolioItem = PortfolioItemFactory::new()->create();

    // Then
    self::assertDatabaseHas('portfolio_items', $portfolioItem->getAttributes());
    self::assertCount(3, $portfolioItem->images);
});
it('should create a portfolio item with bullet points', function () {
    // Given
    $portfolioItem = PortfolioItemFactory::new()->create();

    // Then
    self::assertDatabaseHas('portfolio_items', $portfolioItem->getAttributes());
    self::assertCount(3, $portfolioItem->bulletPoints);
});
