<?php

use App\Models\CaseStudy;
use App\Models\PortfolioItem;
use App\Models\Tag;
use Illuminate\Support\Facades\Storage;

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

    $this->tag = Tag::factory()->create([
        'name' => 'Test Tag',
        'position' => 10,
    ]);

    $this->portfolioItem->tags()->attach($this->tag);
});

it('should return the tags', function () {
    self::assertEquals($this->tag->attributesToArray(), $this->portfolioItem->tags()->first()->attributesToArray());
});

it('should return main image full url with storage when it exists', function () {
    // Arrange
    $fileName = 'test.jpg';
    Storage::put($fileName, 'test');
    $this->portfolioItem->main_image_url = $fileName;
    $this->portfolioItem->save();

    // Act & Assert
    self::assertEquals(url('/storage/test.jpg'), $this->portfolioItem->main_image_full_url);

    Storage::delete($fileName);
});

it('should return main image full url without storage when it does not exist', function () {
    // Arrange
    Storage::fake('public');
    $this->portfolioItem->main_image_url = 'test.jpg';
    $this->portfolioItem->save();

    // Act & Assert
    self::assertEquals(url('test.jpg'), $this->portfolioItem->main_image_full_url);
});

it('should sort on position', function () {
    // Given
    $portfolioItem = PortfolioItem::factory()->create();

    // When
    $position1 = $this->portfolioItem->position;
    $position2 = $portfolioItem->position;

    // Then
    self::assertEquals(1, $position1);
    self::assertEquals(2, $position2);
});

it('should sort images of one portfolio item not affecting the other', function () {
    // Given
    $portfolioItem1 = PortfolioItem::factory()->withImages(2)->create();
    $portfolioItem2 = PortfolioItem::factory()->withImages(2)->create();
    $firstImagePortfolioItem1 = $portfolioItem1->images()->first();
    $firstImagePortfolioItem2 = $portfolioItem2->images()->first();
    self::assertTrue($portfolioItem1->images()->first()->is($firstImagePortfolioItem1));
    self::assertTrue($portfolioItem2->images()->first()->is($firstImagePortfolioItem2));

    // When
    $portfolioItem1->images()->first()->moveOrderDown();
    $firstImagePortfolioItem1 = $portfolioItem1->images()->first();
    $firstImagePortfolioItem2 = $portfolioItem2->images()->first();

    // Then
    self::assertEquals(2, $firstImagePortfolioItem1->position);
    self::assertEquals(1, $firstImagePortfolioItem2->position);
});

it('should sort bullet points of one portfolio item not affecting the other', function () {
    // Given
    $portfolioItem1 = PortfolioItem::factory()->withBulletPoints(2)->create();
    $portfolioItem2 = PortfolioItem::factory()->withBulletPoints(2)->create();
    $firstBulletPointPortfolioItem1 = $portfolioItem1->bulletPoints()->first();
    $firstBulletPointPortfolioItem2 = $portfolioItem2->bulletPoints()->first();
    self::assertTrue($portfolioItem1->bulletPoints()->first()->is($firstBulletPointPortfolioItem1));
    self::assertTrue($portfolioItem2->bulletPoints()->first()->is($firstBulletPointPortfolioItem2));

    // When
    $portfolioItem1->bulletPoints()->first()->moveOrderDown();
    $firstBulletPointPortfolioItem1 = $portfolioItem1->bulletPoints()->first();
    $firstBulletPointPortfolioItem2 = $portfolioItem2->bulletPoints()->first();

    // Then
    self::assertEquals(2, $firstBulletPointPortfolioItem1->position);
    self::assertEquals(1, $firstBulletPointPortfolioItem2->position);
});

test('it can have case study', function () {
    // Given
    $portfolioItem = PortfolioItem::factory()->create();
    $caseStudy = CaseStudy::factory()->create([
        'portfolio_item_id' => $portfolioItem->id,
    ]);

    // When & Then
    expect($portfolioItem->caseStudy->is($caseStudy))->toBeTrue();
    expect($portfolioItem->hasCaseStudy())->toBeTrue();
});

test('has case study returns false when no case study', function () {
    // Given
    $portfolioItem = PortfolioItem::factory()->create();

    // When & Then
    expect($portfolioItem->hasCaseStudy())->toBeFalse();
});
