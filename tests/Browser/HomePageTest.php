<?php

namespace Tests\Browser;

use App\Models\PortfolioItem;
use App\Models\Tag;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class HomePageTest extends DuskTestCase
{
    use DatabaseMigrations;

    /** @test */
    public function it_should_only_show_tags_that_are_visible(): void
    {
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
    }

    /** @test */
    public function it_should_show_all_portfolio_items()
    {
        // Given
        $portfolioItems = PortfolioItem::factory()->count(2)->create();
        $portfolioItems = $portfolioItems->sortBy('position');

        // When & Then
        $this->browse(function (Browser $browser) use ($portfolioItems) {
            $url = route('home');
            $browser
                ->visit($url)
                ->waitFor('@portfolio')
                ->assertSee($portfolioItems->first()->title_en)
                ->assertSee($portfolioItems->last()->title_en);
        });
    }

    /** @test */
    public function it_should_change_language_of_portfolio_items()
    {
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
                ->waitFor('@language-switcher-nl')
                ->waitFor('@portfolio')
                ->click('@language-switcher-nl')
                ->waitForText($portfolioItem->title_nl)
                ->assertSee($portfolioItem->title_nl);
        });
    }
}
