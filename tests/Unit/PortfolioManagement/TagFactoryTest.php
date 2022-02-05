<?php

namespace Tests\Unit\PortfolioManagement;

use App\PortfolioManagement\Domain\PortfolioItems\Image;
use App\PortfolioManagement\Domain\PortfolioItems\TagFactory;
use App\PortfolioManagement\Domain\PortfolioItems\PortfolioItem;
use Tests\TestCase;

class TagFactoryTest extends TestCase
{

    /** @test */
    public function it_should_create_tag()
    {
        $image = TagFactory::single();
        self::assertNotNull($image);
    }

    /** @test */
    public function it_should_create_multiple_tags()
    {
        $amount = 10;
        $images = TagFactory::multiple($amount);
        self::assertEquals($amount, sizeof($images));
    }
}
