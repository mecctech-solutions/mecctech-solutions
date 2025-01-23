<?php

namespace Tests\Browser;

use App\Models\CaseStudy;
use App\Models\PortfolioItem;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class CaseStudyTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function test_user_can_view_case_study_from_portfolio_item(): void
    {
        // Given
        $portfolioItem = PortfolioItem::factory()->create();
        $caseStudy = CaseStudy::factory()->create([
            'portfolio_item_id' => $portfolioItem->id
        ]);

        // When & Then
        $this->browse(function (Browser $browser) use ($portfolioItem, $caseStudy) {
            $browser->visit('/')
                ->waitFor('@portfolio')
                ->click('@portfolio-item-' . $portfolioItem->id)
                ->waitFor('@case-study-button')
                ->click('@case-study-button')
                ->assertPathIs('/case-studies/' . $caseStudy->slug)
                ->assertSee($caseStudy->title_en)
                ->assertSee($caseStudy->content_en);
        });
    }
} 