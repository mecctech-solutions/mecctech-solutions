<?php

use App\Actions\AddPortfolioItems;
use App\Actions\GetAllPortfolioItems;
use App\Data\PortfolioItemData;
use App\Models\BulletPoint;
use App\Models\Image;
use App\Models\PortfolioItem;
use App\Models\Tag;
use Database\Factories\PortfolioItemFactory;

it('should be able to call the route', function () {
    // Given
    $bulletPoints = BulletPoint::factory()->count(3)->make();
    $images = Image::factory()->count(3)->make();
    $tags = Tag::factory()->count(3)->make();

    $n = 0;
    $portfolioItems = PortfolioItemFactory::new()
        ->count(20)
        ->make()
        ->map(function ($portfolioItem) use ($bulletPoints, $images, $tags, &$n) {
            $portfolioItem['bullet_points'] = $bulletPoints->toArray();
            $portfolioItem['images'] = $images->toArray();
            $portfolioItem['tags'] = $tags->toArray();
            $portfolioItem['position'] = $n + 1;

            return $portfolioItem;
        });

    $portfolioItems = PortfolioItemData::collect($portfolioItems);

    // Then
    AddPortfolioItems::partialMock()
        ->shouldReceive('handle')
        ->once()
        ->with($portfolioItems);

    // When
    $response = $this->post(route('add-portfolio-items'), [
        'portfolio_items' => $portfolioItems,
    ]);

    // Then
    $response->assertOk();
});

it('should not add items with same title', function () {
    // Given
    $portfolioItems = PortfolioItemFactory::new()
        ->count(2)
        ->make([
            'title_nl' => 'Same title',
            'title_en' => 'Zelfde titel',
            'position' => 1,
        ]);

    $portfolioItems = PortfolioItemData::collect($portfolioItems);

    // When
    $response = $this->post(route('add-portfolio-items'), [
        'portfolio_items' => $portfolioItems,
    ]);

    $response = $this->post(route('add-portfolio-items'), [
        'portfolio_items' => $portfolioItems,
    ]);

    self::assertEquals(1, PortfolioItem::count());
});

it('should return response with portfolio items', function () {
    $url = route('all-portfolio-items');
    $response = $this->get($url);
    self::assertNotNull($response['meta']['created_at']);
    self::assertNotNull($response['payload']['portfolio_items']);
});

it('should return response with error message when failed to get all portfolio items', function () {
    GetAllPortfolioItems::partialMock()->shouldReceive('handle')->andThrow(new \Exception('Failed to get all portfolio items'));
    $url = route('all-portfolio-items');
    $response = $this->get($url);
    self::assertNotNull($response['meta']['created_at']);
    self::assertNotNull($response['error']['message']);
    self::assertNotNull($response['error']['code']);
});

it('should return response with portfolio items filtered by tag', function () {
    $url = route('all-portfolio-items', [
        'tag' => 'Test Tag',
    ]);
    $response = $this->get($url);
    self::assertNotNull($response['payload']['portfolio_items']);
    self::assertNotNull($response['meta']['created_at']);
});
