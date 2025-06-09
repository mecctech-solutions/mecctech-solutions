<?php

use App\Models\CaseStudy;
use App\Models\PortfolioItem;

uses(\Illuminate\Foundation\Testing\RefreshDatabase::class);

test('it belongs to portfolio item', function () {
    // Given
    $portfolioItem = PortfolioItem::factory()->create();
    $caseStudy = CaseStudy::factory()->create([
        'portfolio_item_id' => $portfolioItem->id,
    ]);

    // When & Then
    expect($caseStudy->portfolioItem->is($portfolioItem))->toBeTrue();
});

test('it can be created with factory', function () {
    // When
    $caseStudy = CaseStudy::factory()->create();

    // Then
    expect($caseStudy->title_nl)->not->toBeNull();
    expect($caseStudy->title_en)->not->toBeNull();
    expect($caseStudy->content_nl)->not->toBeNull();
    expect($caseStudy->content_en)->not->toBeNull();
    expect($caseStudy->slug)->not->toBeNull();
    expect($caseStudy->portfolioItem)->toBeInstanceOf(PortfolioItem::class);
});