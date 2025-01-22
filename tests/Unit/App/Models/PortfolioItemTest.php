<?php

namespace Tests\Unit\App\Models;

use App\Models\PortfolioItem;
use App\Models\Tag;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class PortfolioItemTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

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
    }

    /** @test */
    public function it_should_return_the_tags()
    {
        self::assertEquals($this->tag->attributesToArray(), $this->portfolioItem->tags()->first()->attributesToArray());
    }

    /** @test */
    public function it_should_return_main_image_full_url_with_storage_when_it_exists()
    {
        // Arrange
        $fileName = 'test.jpg';
        Storage::put($fileName, 'test');
        $this->portfolioItem->main_image_url = $fileName;
        $this->portfolioItem->save();

        // Act & Assert
        self::assertEquals(url('/storage/test.jpg'), $this->portfolioItem->main_image_full_url);

        Storage::delete($fileName);
    }

    /** @test */
    public function it_should_return_main_image_full_url_without_storage_when_it_does_not_exist()
    {
        // Arrange
        Storage::fake('public');
        $this->portfolioItem->main_image_url = 'test.jpg';
        $this->portfolioItem->save();

        // Act & Assert
        self::assertEquals(url('test.jpg'), $this->portfolioItem->main_image_full_url);
    }

    /** @test */
    public function it_should_sort_on_position()
    {
        // Given
        $portfolioItem = PortfolioItem::factory()->create();

        // When
        $position1 = $this->portfolioItem->position;
        $position2 = $portfolioItem->position;

        // Then
        self::assertEquals(1, $position1);
        self::assertEquals(2, $position2);
    }

    /** @test */
    public function it_should_sort_images_of_one_portfolio_item_not_affecting_the_other()
    {
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
    }

    /** @test */
    public function it_should_sort_bullet_points_of_one_portfolio_item_not_affecting_the_other()
    {
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
    }
}
