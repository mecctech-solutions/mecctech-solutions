<?php

namespace Tests\Unit\App\Data;

use App\Data\PortfolioItemData;
use Tests\TestCase;

class PortfolioItemDataTest extends TestCase
{
    /** @test */
    public function it_should_handle_descriptions_that_are_null()
    {
        // Given
        $portfolioItem = new PortfolioItemData(
            title_en: 'Title EN',
            title_nl: 'Title NL',
            description_en: null,
            description_nl: null,
            main_image_url: 'main_image_url',
            website_url: 'website_url',
            position: 1,
            bullet_points: null,
            images: null,
            tags: null,
        );

        // When
        $descriptionEn = $portfolioItem->description_en;
        $descriptionNl = $portfolioItem->description_nl;

        // Then
        self::assertNull($descriptionEn);
        self::assertNull($descriptionNl);
    }
}
