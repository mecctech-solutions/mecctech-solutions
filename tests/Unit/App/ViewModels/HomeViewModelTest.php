<?php

use App\Models\CaseStudy;
use App\Models\Client;
use App\Models\PortfolioItem;
use App\Models\Tag;
use App\Models\Testimonial;
use App\ViewModels\HomeViewModel;
use Database\Factories\PortfolioItemFactory;

uses(\Illuminate\Foundation\Testing\RefreshDatabase::class);

beforeEach(function () {
    $this->viewModel = new HomeViewModel;
});

test('it returns portfolio items with case studies', function () {
    // Given
    $portfolioItem = PortfolioItem::factory()->create();
    $caseStudy = CaseStudy::factory()->create([
        'portfolio_item_id' => $portfolioItem->id,
    ]);

    // When
    $items = $this->viewModel->portfolioItems();

    // Then
    expect($items)->toHaveCount(1);
    expect($items->first()->has_case_study)->toBeTrue();
    expect($items->first()->case_study_slug)->toEqual($caseStudy->slug);
});

test('it returns portfolio items filtered by tag', function () {
    // Given
    $tag = Tag::factory()->create();
    $portfolioItem = PortfolioItem::factory()->create();
    $portfolioItem->tags()->attach($tag);

    PortfolioItem::factory()->create();

    // Another item without the tag
    // When
    $viewModel = new HomeViewModel($tag->name);
    $items = $viewModel->portfolioItems();

    // Then
    expect($items)->toHaveCount(1);
});

test('it returns visible tags', function () {
    // Given
    Tag::factory()->count(3)->create(['visible' => true]);
    Tag::factory()->create(['visible' => false]);

    // When
    $tags = $this->viewModel->tags();

    // Then
    expect($tags)->toHaveCount(3);
});

test('it returns testimonials ordered by position', function () {
    // Given
    $firstTestimonial = Testimonial::factory()->create(['position' => 1]);
    $secondTestimonial = Testimonial::factory()->create(['position' => 2]);

    // When
    $testimonials = $this->viewModel->testimonials();

    // Then
    expect($testimonials)->toHaveCount(2);
    expect($testimonials->first()->id)->toEqual($firstTestimonial->id);
});

test('it returns clients ordered by position', function () {
    // Given
    $firstClient = Client::factory()->create(['position' => 1]);
    $secondClient = Client::factory()->create(['position' => 2]);

    // When
    $clients = $this->viewModel->clients();

    // Then
    expect($clients)->toHaveCount(2);
    expect($clients->first()->id)->toEqual($firstClient->id);
});

it('should paginate portfolio items', function () {
    // Given
    PortfolioItemFactory::new()
        ->count(10)
        ->create()
        ->load('tags', 'images', 'bulletPoints', 'caseStudy');

    // When
    $viewModel = new HomeViewModel;
    $result = $viewModel->portfolioItems();

    // Then
    expect($result->perPage())->toEqual(6);
    expect($result->total())->toEqual(10);
    expect($result->lastPage())->toEqual(2);
    expect($result->items())->toHaveCount(6);
});

it('should respect current page', function () {
    // Given
    PortfolioItemFactory::new()
        ->count(10)
        ->create()
        ->load('tags', 'images', 'bulletPoints', 'caseStudy');

    $this->get('/?page=2');

    // When
    $viewModel = new HomeViewModel;
    $result = $viewModel->portfolioItems();

    // Then
    expect($result->currentPage())->toEqual(2);
    expect($result->items())->toHaveCount(4);
    // Second page should have 4 items (10 total - 6 on first page)
});