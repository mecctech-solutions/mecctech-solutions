<?php

namespace Tests\Unit\Models;

use App\Models\CaseStudy;
use App\Models\PortfolioItem;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PortfolioItemTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_can_have_case_study(): void
    {
        // Given
        $portfolioItem = PortfolioItem::factory()->create();
        $caseStudy = CaseStudy::factory()->create([
            'portfolio_item_id' => $portfolioItem->id,
        ]);

        // When & Then
        $this->assertTrue($portfolioItem->caseStudy->is($caseStudy));
        $this->assertTrue($portfolioItem->hasCaseStudy());
    }

    public function test_has_case_study_returns_false_when_no_case_study(): void
    {
        // Given
        $portfolioItem = PortfolioItem::factory()->create();

        // When & Then
        $this->assertFalse($portfolioItem->hasCaseStudy());
    }
}
