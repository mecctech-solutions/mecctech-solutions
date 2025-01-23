<?php

namespace Feature\Controllers;

use Database\Factories\PortfolioItemFactory;
use Inertia\Testing\AssertableInertia;
use Tests\TestCase;

class PageControllerTest extends TestCase
{
    /** @test */
    public function it_should_render_home_page_with_portfolio_items()
    {
        // Given
        $portfolioItem = PortfolioItemFactory::new()->create();

        // When
        $response = $this->get(route('home'));

        // Then
        $response->assertInertia(function (AssertableInertia $page) use ($portfolioItem) {
            $page->component('Home');
            $page->has('portfolioItems', 1)
                ->has('portfolioItems.0', function (AssertableInertia $page) use ($portfolioItem) {
                    $page
                        ->where('title_nl', $portfolioItem->title_nl)
                        ->where('title_en', $portfolioItem->title_en)
                        ->where('description_nl', $portfolioItem->description_nl)
                        ->where('description_en', $portfolioItem->description_en)
                        ->where('website_url', $portfolioItem->website_url)
                        ->where('main_image_url', $portfolioItem->main_image_url)
                        ->where('main_image_full_url', $portfolioItem->main_image_full_url)
                        ->where('position', $portfolioItem->position)
                        ->where('visible', (bool) $portfolioItem->visible)
                        ->has('tags', $portfolioItem->tags->count())
                        ->has('tags.0', function (AssertableInertia $page) use ($portfolioItem) {
                            $page
                                ->where('name', $portfolioItem->tags->first()->name)
                                ->where('visible', (bool) $portfolioItem->tags->first()->visible);
                        })
                        ->has('images', $portfolioItem->images->count())
                        ->has('images.0', function (AssertableInertia $page) use ($portfolioItem) {
                            $page
                                ->where('url', $portfolioItem->images->first()->url)
                                ->where('full_url', $portfolioItem->images->first()->full_url)
                                ->where('position', $portfolioItem->images->first()->position);
                        })
                        ->has('bullet_points', $portfolioItem->bulletPoints->count())
                        ->has('bullet_points.0', function (AssertableInertia $page) use ($portfolioItem) {
                            $page
                                ->where('text_nl', $portfolioItem->bulletPoints->first()->text_nl)
                                ->where('text_en', $portfolioItem->bulletPoints->first()->text_en)
                                ->where('position', $portfolioItem->bulletPoints->first()->position);
                        });
                });
        });
    }
}
