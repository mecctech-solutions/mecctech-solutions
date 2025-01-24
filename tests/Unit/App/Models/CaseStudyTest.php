<?php

namespace Tests\Unit\App\Models;

use App\Models\CaseStudy;
use App\Models\PortfolioItem;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CaseStudyTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_belongs_to_portfolio_item(): void
    {
        // Given
        $portfolioItem = PortfolioItem::factory()->create();
        $caseStudy = CaseStudy::factory()->create([
            'portfolio_item_id' => $portfolioItem->id,
        ]);

        // When & Then
        $this->assertTrue($caseStudy->portfolioItem->is($portfolioItem));
    }

    public function test_it_can_be_created_with_factory(): void
    {
        // When
        $caseStudy = CaseStudy::factory()->create();

        // Then
        $this->assertNotNull($caseStudy->title_nl);
        $this->assertNotNull($caseStudy->title_en);
        $this->assertNotNull($caseStudy->content_nl);
        $this->assertNotNull($caseStudy->content_en);
        $this->assertNotNull($caseStudy->slug);
        $this->assertInstanceOf(PortfolioItem::class, $caseStudy->portfolioItem);
    }
}
