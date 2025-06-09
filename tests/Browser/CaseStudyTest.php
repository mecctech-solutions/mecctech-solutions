<?php

use App\Models\CaseStudy;
use App\Models\PortfolioItem;
use Laravel\Dusk\Browser;

test('user can view case study from portfolio item', function () {
    // Given
    $portfolioItem = PortfolioItem::factory()->create();
    $caseStudy = CaseStudy::factory()->create([
        'portfolio_item_id' => $portfolioItem->id,
        'title_en' => 'Test Case Study Title',
        'content_en' => 'Test Case Study Content',
        'title_nl' => 'Test Case Study Titel',
        'content_nl' => 'Test Case Study Inhoud',
    ]);

    // When & Then
    $this->browse(function (Browser $browser) use ($portfolioItem, $caseStudy) {
        $browser->visit('/')
            ->waitFor('@portfolio')
            ->scrollIntoView('@portfolio-item-'.$portfolioItem->id)
            ->pause(500)
            ->click('@portfolio-item-toggle-modal-'.$portfolioItem->id)
            ->waitFor('@case-study-button')
            ->click('@case-study-button')
            ->pause(500)
            ->waitForLocation('/case-studies/'.$caseStudy->slug)
            ->assertUrlIs(route('case-studies.show', $caseStudy->slug))
            ->waitFor('@case-study-title')
            ->assertSee($caseStudy->title_nl)
            ->assertSee($caseStudy->content_nl);
    });
});
