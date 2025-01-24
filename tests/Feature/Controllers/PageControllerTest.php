<?php

namespace Tests\Feature\Controllers;

use App\Models\Client;
use App\Models\PortfolioItem;
use App\Models\Testimonial;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Inertia\Testing\AssertableInertia;
use Tests\TestCase;

class PageControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_should_render_home_page_with_portfolio_items(): void
    {
        // Given
        $portfolioItem = PortfolioItem::factory()
            ->withTags([])
            ->withImages()
            ->withBulletPoints()
            ->create();

        // When
        $response = $this->get(route('home'));

        // Then
        $response->assertInertia(function (AssertableInertia $page) use ($portfolioItem) {
            $page->component('Home');
            $page->has('portfolioItems', fn (AssertableInertia $page) => $page
                ->has('data', 1)
                ->has('data.0', function (AssertableInertia $page) use ($portfolioItem) {
                    $page
                        ->where('id', $portfolioItem->id)
                        ->where('title_nl', $portfolioItem->title_nl)
                        ->where('title_en', $portfolioItem->title_en)
                        ->where('description_nl', $portfolioItem->description_nl)
                        ->where('description_en', $portfolioItem->description_en)
                        ->where('website_url', $portfolioItem->website_url)
                        ->where('main_image_url', $portfolioItem->main_image_url)
                        ->where('main_image_full_url', $portfolioItem->main_image_full_url)
                        ->where('position', $portfolioItem->position)
                        ->where('visible', (bool) $portfolioItem->visible)
                        ->where('has_case_study', $portfolioItem->hasCaseStudy())
                        ->where('case_study_slug', $portfolioItem->caseStudy?->slug)
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
                })
            )
                ->has('links')
                ->has('current_page')
                ->has('last_page')
                ->has('per_page')
                ->has('total');
        });
    }

    public function test_home_page_includes_clients(): void
    {
        // Given
        $this->withoutExceptionHandling();
        $client = Client::factory()
            ->has(Testimonial::factory())
            ->create();

        // When
        $response = $this->get(route('home'));

        // Then
        $response->assertInertia(function (AssertableInertia $page) use ($client) {
            $page->component('Home')
                ->has('clients', 1)
                ->has('clients.0', function (AssertableInertia $page) use ($client) {
                    $page
                        ->where('id', $client->id)
                        ->where('position', $client->position)
                        ->where('name', $client->name)
                        ->where('website_url', $client->website_url)
                        ->where('logo_url', $client->logo_url)
                        ->where('logo_full_url', $client->logo_full_url);
                });
        });
    }

    public function test_home_page_includes_testimonials(): void
    {
        // Given
        $this->withoutExceptionHandling();
        $client = Client::factory()->create();
        $testimonial = Testimonial::factory()
            ->for($client)
            ->create();

        // When
        $response = $this->get(route('home'));

        // Then
        $response->assertInertia(function (AssertableInertia $page) use ($testimonial) {
            $page->component('Home')
                ->has('testimonials', 1)
                ->has('testimonials.0', function ($page) use ($testimonial) {
                    $page
                        ->where('id', $testimonial->id)
                        ->where('name', $testimonial->name)
                        ->where('job_title_en', $testimonial->job_title_en)
                        ->where('job_title_nl', $testimonial->job_title_nl)
                        ->where('position', $testimonial->position)
                        ->where('text_nl', $testimonial->text_nl)
                        ->where('text_en', $testimonial->text_en)
                        ->where('image_url', $testimonial->image_url)
                        ->where('image_full_url', $testimonial->image_full_url)
                        ->where('client_name', $testimonial?->client->name);
                });
        });
    }
}
