<?php

namespace Tests\Unit\PortfolioManagement;

use App\PortfolioManagement\Domain\PortfolioItems\Description;
use App\PortfolioManagement\Domain\PortfolioItems\Image;
use App\PortfolioManagement\Domain\PortfolioItems\ImageFactory;
use App\PortfolioManagement\Domain\PortfolioItems\TagFactory;
use App\PortfolioManagement\Domain\PortfolioItems\PortfolioItem;
use App\PortfolioManagement\Domain\PortfolioItems\Title;
use Tests\TestCase;

class PortfolioItemTest extends TestCase
{
    private PortfolioItem $portfolioItem;

    protected function setUp(): void
    {
        parent::setUp(); // TODO: Change the autogenerated stub

        $this->title = new Title("Test Portfolio Item Title", "Test Portfolio Item Titel");
        $this->mainImage = new Image("/images/placeholder.png");
        $this->description = new Description("Test Portfolio Item Description", "Test Portfolio Item Beschrijving");
        $this->websiteUrl = "Test Portfolio Item Website Url";
        $this->images = ImageFactory::placeholders(4);
        $this->tags = TagFactory::multiple(10);
        $this->portfolioItem = new PortfolioItem($this->title, $this->mainImage, $this->description, $this->websiteUrl, $this->images, $this->tags);
    }


    /** @test */
    public function it_should_return_the_correcy_title()
    {
        self::assertEquals($this->title, $this->portfolioItem->title());
    }


    /** @test */
    public function it_should_return_the_main_image()
    {
        self::assertEquals($this->mainImage, $this->portfolioItem->mainImage());
    }

    /** @test */
    public function it_should_return_the_correct_description()
    {
        self::assertEquals($this->description, $this->portfolioItem->description());
    }

    /** @test */
    public function it_should_return_the_correct_website_url()
    {
        self::assertEquals($this->websiteUrl, $this->portfolioItem->websiteUrl());
    }

    /** @test */
    public function it_should_return_the_correct_images()
    {
        self::assertEquals($this->images, $this->portfolioItem->images());
    }

    /** @test */
    public function it_should_return_the_correct_tags()
    {
        self::assertEquals($this->tags, $this->portfolioItem->tags());
    }

    /** @test */
    public function it_should_return_the_object_as_array()
    {
        $imagesAsArray = [];
        $tagsAsArray = [];

        foreach ($this->images as $image)
        {
            $imagesAsArray[] = $image->asArray();
        }

        foreach ($this->tags as $tag)
        {
            $tagsAsArray[] = $tag;
        }

        $expectedArray = [
            "title" => $this->title->toArray(),
            "main_image" => $this->mainImage->asArray(),
            "description" => $this->description->toArray(),
            "website_url" => $this->websiteUrl,
            "images" => $imagesAsArray,
            "tags" => $tagsAsArray
        ];

        self::assertEquals($expectedArray, $this->portfolioItem->asArray());
    }
}
