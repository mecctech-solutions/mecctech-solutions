<?php

namespace Tests\Unit\PortfolioManagement;

use App\PortfolioManagement\Domain\PortfolioItems\Image;
use App\PortfolioManagement\Domain\PortfolioItems\ImageFactory;
use App\PortfolioManagement\Domain\PortfolioItems\TagFactory;
use App\PortfolioManagement\Domain\PortfolioItems\PortfolioItem;
use Tests\TestCase;

class ImageFactoryTest extends TestCase
{

    /** @test */
    public function it_should_create_placeholder()
    {
        $image = ImageFactory::placeholder();
        self::assertNotNull($image);
    }

    /** @test */
    public function it_should_create_multiple_placeholders()
    {
        $amount = 10;
        $images = ImageFactory::placeholders($amount);
        self::assertEquals($amount, sizeof($images));
    }
}
