<?php

use App\Data\PortfolioItemData;

it('should handle descriptions that are null', function () {
    // Given
    $portfolioItem = new PortfolioItemData(
        id: 1,
        title_en: 'Title EN',
        title_nl: 'Title NL',
        description_en: null,
        description_nl: null,
        main_image_url: 'main_image_url',
        website_url: 'website_url',
        position: 1,
        visible: true,
        has_case_study: false,
        case_study_slug: null,
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
});
