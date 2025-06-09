<?php

use App\Models\Image;
use App\Models\PortfolioItem;

uses(\Illuminate\Foundation\Testing\RefreshDatabase::class);

beforeEach(function () {
    $this->portfolioItem = new PortfolioItem([
        'title_en' => 'Test Title',
        'title_nl' => 'Test Titel',
        'main_image_url' => 'Test Url',
        'description_nl' => 'Test Beschrijving',
        'description_en' => 'Test Description',
        'website_url' => 'Test Website Url',
    ]);

    $this->portfolioItem->save();

    $this->image = new Image([
        'url' => '/images/placeholder.png',
        'portfolio_item_id' => $this->portfolioItem->id,
    ]);
});

it('should return url with storage when it exists', function () {
    // Arrange
    $fileName = 'test.jpg';
    \Storage::put($fileName, 'test');
    $this->image->url = $fileName;
    $this->image->save();

    // Act & Assert
    self::assertEquals(url('/storage/test.jpg'), $this->image->full_url);

    \Storage::delete($fileName);
});

it('should return main image url without storage when it does not exist', function () {
    // Arrange
    \Storage::fake('public');
    $this->image->url = 'test.jpg';
    $this->image->save();

    // Act & Assert
    self::assertEquals(url('test.jpg'), $this->image->full_url);
});
