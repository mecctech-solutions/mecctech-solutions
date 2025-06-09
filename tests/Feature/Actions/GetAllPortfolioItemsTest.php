<?php

use App\Actions\GetAllPortfolioItems;
use App\Models\BulletPoint;
use App\Models\Image;
use App\Models\PortfolioItem;
use Database\Factories\PortfolioItemFactory;

it('should return all portfolio items', function () {
    self::assertEmpty(PortfolioItem::all());
    $portfolioItems = PortfolioItemFactory::new()
        ->count(10)
        ->create([
            'description_en' => null,
            'description_nl' => null,
        ])
        ->load('tags', 'images', 'bulletPoints', 'caseStudy')
        ->sortBy('position')
        ->values();

    self::assertEquals($portfolioItems->toArray(), GetAllPortfolioItems::run()->toArray());
});

it('should sort on position', function () {
    $portfolioItems = PortfolioItemFactory::new()->count(10)->create();

    $sortedPortfolioItems = $portfolioItems->sortBy(fn (PortfolioItem $portfolioItem) => $portfolioItem->position);

    self::assertEquals($sortedPortfolioItems->pluck('position'), GetAllPortfolioItems::run()->pluck('position'));
});

it('should return portfolio items with certain tag', function () {
    // Given
    $firstTag = 'Tag 1';
    $secondTag = 'Tag 2';
    $portfolioItemsWithFirstTag = PortfolioItemFactory::new()
        ->count(5)
        ->withTags(['name' => $firstTag])
        ->create()
        ->load('tags', 'images', 'bulletPoints', 'caseStudy')
        ->sortBy('position')
        ->values();

    PortfolioItemFactory::new()
        ->count(5)
        ->withTags(['name' => $secondTag])
        ->create();

    // When
    $result = GetAllPortfolioItems::run($firstTag);
    self::assertEquals($portfolioItemsWithFirstTag->toArray(), $result->toArray());
});

it('should sort images and bullet points by position', function () {
    // Given
    $portfolioItem = PortfolioItemFactory::new()->create();
    $images = $portfolioItem->images;
    $bulletPoints = $portfolioItem->bulletPoints;
    $sortedImages = $images->sortBy('position');
    $sortedBulletPoints = $bulletPoints->sortBy('position');

    // When
    $result = GetAllPortfolioItems::run()->first();

    // Then
    self::assertEquals($sortedImages->pluck('position'), collect($result->images)->map(fn (Image $image) => $image->position));
    self::assertEquals($sortedBulletPoints->pluck('position'), collect($result->bulletPoints)->map(fn (BulletPoint $bulletPoint) => $bulletPoint->position));
});

it('should filter out invisible portfolio items', function () {
    // Given
    $textVisible = 'Visible Item';
    $textInvisible = 'Invisible Item';
    $visiblePortfolioItem = PortfolioItemFactory::new()->create(['title_en' => $textVisible, 'visible' => true]);
    $invisiblePortfolioItem = PortfolioItemFactory::new()->create(['title_en' => $textInvisible, 'visible' => false]);

    // When
    $result = GetAllPortfolioItems::run();

    // Then
    self::assertEquals($visiblePortfolioItem->title_en, $result->first()->title_en);
});
