<?php

use App\Models\CaseStudy;
use Inertia\Testing\AssertableInertia;

uses(\Illuminate\Foundation\Testing\RefreshDatabase::class);

test('it shows case study page', function () {
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
});

test('it returns 404 for non existent case study', function () {
    $this->get(route('case-studies.show', ['caseStudy' => 'non-existent']))
        ->assertNotFound();
});