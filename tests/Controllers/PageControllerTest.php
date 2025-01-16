<?php

namespace Tests\Controllers;

use App\Models\PortfolioItem;
use Inertia\Testing\AssertableInertia;
use Tests\TestCase;

class PageControllerTest extends TestCase
{
    /** @test */
    public function it_should_render_home_page_with_portfolio_items()
    {
        // Given
        $portfolioItem = PortfolioItem::factory()->create();

        // When
        $response = $this->get(route('home'));

        $response->assertStatus(200);
        $response->assertInertia(function (AssertableInertia $page) use ($portfolioItem) {
            $page->component('Home');
            $page->has('portfolioItems', 1)
            ->has('portfolioItems.0', function (AssertableInertia $page) use ($portfolioItem) {
                $page->has('title_nl')
                    ->has('title_en')
                    ->has('description_nl')
                    ->has('description_en')
                    ->has('website_url')
                    ->has('main_image_url')
                    ->has('main_image_full_url')
                    ->has('tags')
                    ->has('images')
                    ->has('bullet_points')
                    ->has('position');
            });
        });
    }
}
