<?php

namespace Tests\Unit\PortfolioManagement;

use App\PortfolioManagement\Infrastructure\Persistence\Eloquent\PortfolioItems\EloquentImage;
use App\PortfolioManagement\Infrastructure\Persistence\Eloquent\PortfolioItems\EloquentPortfolioItem;
use Tests\TestCase;

class EloquentImageTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->eloquentPortfolioItem = new EloquentPortfolioItem([
            "title_en" => "Test Title",
            "title_nl" => "Test Titel",
            "main_image_url" => "Test Url",
            "description_nl" => "Test Beschrijving",
            "description_en" => "Test Description",
            "website_url" => "Test Website Url"
        ]);

        $this->eloquentPortfolioItem->save();

        $this->eloquentImage = new EloquentImage([
            "url" => "/images/placeholder.png",
            "portfolio_item_id" => $this->eloquentPortfolioItem->id,
        ]);
    }

    /** @test */
    public function it_should_return_url_with_storage_when_it_exists()
    {
        // Arrange
        $fileName = "test.jpg";
        \Storage::put($fileName, "test");
        $this->eloquentImage->url = $fileName;
        $this->eloquentImage->save();

        // Act & Assert
        self::assertEquals(url("/storage/test.jpg"), $this->eloquentImage->url);

        \Storage::delete($fileName);
    }

    /** @test */
    public function it_should_return_main_image_url_without_storage_when_it_does_not_exist()
    {
        // Arrange
        $this->eloquentImage->url = "test.jpg";
        $this->eloquentImage->save();

        // Act & Assert
        self::assertEquals(url("test.jpg"), $this->eloquentImage->url);
    }
}

