<?php

use App\Models\PortfolioItem;
use App\Models\Tag;
use Laravel\Dusk\Browser;

it('should only show tags that are visible', function () {
    // Given
    $visibleTag = Tag::factory()->create([
        'visible' => true,
        'name' => 'Visible Tag',
    ]);

    $invisibleTag = Tag::factory()->create([
        'visible' => false,
        'name' => 'Invisible Tag',
    ]);

    // When & Then
    $this->browse(function (Browser $browser) use ($visibleTag, $invisibleTag) {
        $url = route('home');
        $browser
            ->visit($url)
            ->waitFor('@portfolio')
            ->assertSee($visibleTag->name)
            ->assertDontSee($invisibleTag->name);
    });
});

it('should show all portfolio items', function () {
    // Given
    $portfolioItems = PortfolioItem::factory()->count(2)->create();
    $portfolioItems = $portfolioItems->sortBy('position');

    // When & Then
    $this->browse(function (Browser $browser) use ($portfolioItems) {
        $url = route('home');
        $browser
            ->visit($url)
            ->waitFor('@portfolio')
            ->assertSee($portfolioItems->first()->title_nl)
            ->assertSee($portfolioItems->last()->title_nl);
    });
});

it('should change language of portfolio items', function () {
    // Given
    $portfolioItem = PortfolioItem::factory()->create([
        'title_en' => 'English Title',
        'title_nl' => 'Dutch Title',
    ]);

    // When & Then
    $this->browse(function (Browser $browser) use ($portfolioItem) {
        $url = route('home');
        $browser
            ->visit($url)
            ->waitFor('@language-switcher-en')
            ->waitFor('@portfolio')
            ->click('@language-switcher-en')
            ->waitForText($portfolioItem->title_en)
            ->assertSee($portfolioItem->title_en);
    });
});
