<?php

use Database\Factories\PortfolioItemFactory;

it('should return all portfolio items', function () {
    PortfolioItemFactory::new()->count(10)->create();
    $response = $this->get(route('all-portfolio-items'));
    $portfolioItems = $response['payload']['portfolio_items']['data'];
    self::assertCount(10, $portfolioItems);
});

it('should return portfolio items with tag when route is called', function () {
    $tag = 'Tag 1';
    PortfolioItemFactory::new()
        ->count(5)
        ->withTags(['name' => $tag])
        ->create();

    $response = $this->get(route('all-portfolio-items').'?tag='.$tag);

    $portfolioItems = $response['payload']['portfolio_items']['data'];

    self::assertNotEmpty($portfolioItems);

    foreach ($portfolioItems as $portfolioItem) {
        self::assertNotEmpty($portfolioItem);
    }
});
