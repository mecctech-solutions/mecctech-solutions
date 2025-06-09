<?php

use App\Services\CsvPortfolioItemsConverter;
use Illuminate\Http\UploadedFile;

it('should convert excel file to portfolio items', function () {
    // Given
    $portfolioItems = [
        ['Title', 'Titel', 'Main Image URL', 'Description', 'Beschrijving', 'Website URL', 'Image 1 URL', 'Image 2 URL', 'Image 3 URL', 'Image 4 URL', 'Image 5 URL', 'Image 6 URL', 'Image 7 URL', 'Tag 1', 'Tag 2', 'Tag 3', 'Tag 4', 'Bullet 1 NL', 'Bullet 1 EN', 'Bullet 2 NL', 'Bullet 2 EN', 'Bullet 3 NL', 'Bullet 3 EN'],
        ['Test Title 1', 'Test Titel 1', 'main-image-url-1', 'Description 1', 'Beschrijving 1', 'website-url-1', 'image-1-url', 'image-2-url', 'image-3-url', 'image-4-url', 'image-5-url', 'image-6-url', 'image-7-url', 'Tag 1', 'Tag 2', 'Tag 3', 'Tag 4', 'Bullet 1 NL', 'Bullet 1 EN', 'Bullet 2 NL', 'Bullet 2 EN', 'Bullet 3 NL', 'Bullet 3 EN'],
    ];

    $filename = 'portfolio_items.csv';
    $path = storage_path().'/imports/'.$filename;

    $file = fopen($path, 'w');
    foreach ($portfolioItems as $portfolioItem) {
        fputcsv($file, $portfolioItem);
    }

    fclose($file);

    $file = new UploadedFile($path, $filename, null, null, true);

    // When
    $portfolioItems = CsvPortfolioItemsConverter::import($file);

    // Then
    self::assertEquals(1, count($portfolioItems));
    self::assertEquals('Test Title 1', $portfolioItems->first()->title_en);
    self::assertEquals('Test Titel 1', $portfolioItems->first()->title_nl);
    self::assertEquals('images/main-image-url-1', $portfolioItems->first()->main_image_url);
    self::assertEquals('Description 1', $portfolioItems->first()->description_en);
    self::assertEquals('Beschrijving 1', $portfolioItems->first()->description_nl);
    self::assertEquals('website-url-1', $portfolioItems->first()->website_url);
    self::assertEquals(3, count($portfolioItems->first()->bullet_points));
    self::assertEquals('Bullet 1 NL', $portfolioItems->first()->bullet_points[0]->text_nl);
    self::assertEquals('Bullet 2 NL', $portfolioItems->first()->bullet_points[1]->text_nl);
    self::assertEquals('Bullet 3 NL', $portfolioItems->first()->bullet_points[2]->text_nl);
    self::assertEquals('Bullet 1 EN', $portfolioItems->first()->bullet_points[0]->text_en);
    self::assertEquals('Bullet 2 EN', $portfolioItems->first()->bullet_points[1]->text_en);
    self::assertEquals('Bullet 3 EN', $portfolioItems->first()->bullet_points[2]->text_en);
    self::assertEquals(4, count($portfolioItems->first()->tags));
    self::assertEquals('Tag 1', $portfolioItems->first()->tags[0]->name);
    self::assertEquals('Tag 2', $portfolioItems->first()->tags[1]->name);
    self::assertEquals('Tag 3', $portfolioItems->first()->tags[2]->name);
    self::assertEquals('Tag 4', $portfolioItems->first()->tags[3]->name);
    self::assertEquals(7, count($portfolioItems->first()->images));
    self::assertEquals('images/image-1-url', $portfolioItems->first()->images[0]->url);
    self::assertEquals('images/image-2-url', $portfolioItems->first()->images[1]->url);
    self::assertEquals('images/image-3-url', $portfolioItems->first()->images[2]->url);
    self::assertEquals('images/image-4-url', $portfolioItems->first()->images[3]->url);
    self::assertEquals('images/image-5-url', $portfolioItems->first()->images[4]->url);
    self::assertEquals('images/image-6-url', $portfolioItems->first()->images[5]->url);
    self::assertEquals('images/image-7-url', $portfolioItems->first()->images[6]->url);
});

it('should have no images', function () {
    // Given
    $portfolioItems = [
        ['Title', 'Titel', 'Main Image URL', 'Description', 'Beschrijving', 'Website URL', 'Image 1 URL', 'Image 2 URL', 'Image 3 URL', 'Image 4 URL', 'Image 5 URL', 'Image 6 URL', 'Image 7 URL', 'Tag 1', 'Tag 2', 'Tag 3', 'Tag 4', 'Bullet 1 NL', 'Bullet 1 NL', 'Bullet 2 NL', 'Bullet 2 NL', 'Bullet 3 NL', 'Bullet 3 EN'],
        ['Test Title 1', 'Test Titel 1', 'main-image-url-1', 'Description 1', 'Beschrijving 1', 'website-url-1', '', '', '', '', '', '', '', 'Tag 1', 'Tag 2', 'Tag 3', 'Tag 4', 'Bullet 1', 'bullet 2', 'Bullet 3', 'Bullet 4', 'Bullet 5', 'Bullet 6'],
    ];

    $filename = 'portfolio_items.csv';
    $path = storage_path().'/imports/'.$filename;

    $file = fopen($path, 'w');
    foreach ($portfolioItems as $portfolioItem) {
        fputcsv($file, $portfolioItem);
    }

    fclose($file);

    $file = new UploadedFile($path, $filename, null, null, true);

    // When
    $portfolioItems = CsvPortfolioItemsConverter::import($file);

    // Then
    self::assertEmpty($portfolioItems->first()->images);
});

it('should have no tags', function () {
    // Given
    $portfolioItems = [
        ['Title', 'Titel', 'Main Image URL', 'Description', 'Beschrijving', 'Website URL', 'Image 1 URL', 'Image 2 URL', 'Image 3 URL', 'Image 4 URL', 'Image 5 URL', 'Image 6 URL', 'Image 7 URL', 'Tag 1', 'Tag 2', 'Tag 3', 'Tag 4', 'Bullet 1 NL', 'Bullet 1 NL', 'Bullet 2 NL', 'Bullet 2 NL', 'Bullet 3 NL', 'Bullet 3 EN'],
        ['Test Title 1', 'Test Titel 1', 'main-image-url-1', 'Description 1', 'Beschrijving 1', 'website-url-1', 'image-1-url', 'image-2-url', 'image-3-url', 'image-4-url', 'image-5-url', 'image-6-url', 'image-7-url', '', '', '', '', 'Bullet 1', 'bullet 2', 'Bullet 3', 'Bullet 4', 'Bullet 5', 'Bullet 6'],
    ];

    $filename = 'portfolio_items.csv';
    $path = storage_path().'/imports/'.$filename;

    $file = fopen($path, 'w');
    foreach ($portfolioItems as $portfolioItem) {
        fputcsv($file, $portfolioItem);
    }

    fclose($file);

    $file = new UploadedFile($path, $filename, null, null, true);

    // When
    $portfolioItems = CsvPortfolioItemsConverter::import($file);

    // Then
    self::assertEmpty($portfolioItems->first()->tags);
});
