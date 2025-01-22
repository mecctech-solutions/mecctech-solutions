<?php

namespace tests\Unit\App\Models;

use App\Models\Image;
use App\Models\PortfolioItem;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ImageTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->portfolioItem = new PortfolioItem([
            "title_en" => "Test Title",
            "title_nl" => "Test Titel",
            "main_image_url" => "Test Url",
            "description_nl" => "Test Beschrijving",
            "description_en" => "Test Description",
            "website_url" => "Test Website Url"
        ]);

        $this->portfolioItem->save();

        $this->image = new Image([
            "url" => "/images/placeholder.png",
            "portfolio_item_id" => $this->portfolioItem->id,
        ]);
    }

    /** @test */
    public function it_should_return_url_with_storage_when_it_exists()
    {
        // Arrange
        $fileName = "test.jpg";
        \Storage::put($fileName, "test");
        $this->image->url = $fileName;
        $this->image->save();

        // Act & Assert
        self::assertEquals(url("/storage/test.jpg"), $this->image->full_url);

        \Storage::delete($fileName);
    }

    /** @test */
    public function it_should_return_main_image_url_without_storage_when_it_does_not_exist()
    {
        // Arrange
        \Storage::fake('public');
        $this->image->url = "test.jpg";
        $this->image->save();

        // Act & Assert
        self::assertEquals(url("test.jpg"), $this->image->full_url);
    }
}

