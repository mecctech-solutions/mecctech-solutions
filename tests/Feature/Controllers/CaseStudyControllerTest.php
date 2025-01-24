<?php

namespace Tests\Feature\Controllers;

use App\Models\CaseStudy;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Inertia\Testing\AssertableInertia;
use Tests\TestCase;

class CaseStudyControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_shows_case_study_page(): void
    {
        // Given
        $caseStudy = CaseStudy::factory()->create();

        // When
        $response = $this->get(route('case-studies.show', $caseStudy));

        // Then
        $response->assertInertia(function (AssertableInertia $page) use ($caseStudy) {
            $page->component('CaseStudy')
                ->has('caseStudy', fn (AssertableInertia $page) => $page
                    ->where('id', $caseStudy->id)
                    ->where('title_nl', $caseStudy->title_nl)
                    ->where('title_en', $caseStudy->title_en)
                    ->where('content_nl', $caseStudy->content_nl)
                    ->where('content_en', $caseStudy->content_en)
                    ->where('slug', $caseStudy->slug)
                    ->etc()
                );
        });
    }

    public function test_it_returns_404_for_non_existent_case_study(): void
    {
        $this->get(route('case-studies.show', ['caseStudy' => 'non-existent']))
            ->assertNotFound();
    }
}
