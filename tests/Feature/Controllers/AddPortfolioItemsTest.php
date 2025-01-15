<?php

namespace Tests\Feature\Controllers;

use App\Actions\AddPortfolioItems;
use App\Actions\GetAllPortfolioItems;
use App\Models\BulletPoint;
use App\Models\Image;
use App\Models\PortfolioItem;
use App\Models\Tag;
use Database\Factories\PortfolioItemFactory;
use Tests\TestCase;

class AddPortfolioItemsTest extends TestCase
{

    /** @test */
    public function it_should_be_able_to_call_the_route()
    {
        // Given
        $bulletPoints = BulletPoint::factory()->count(3)->make();
        $images = Image::factory()->count(3)->make();
        $tags = Tag::factory()->count(3)->make();
        $portfolioItems = PortfolioItemFactory::new()
            ->count(20)
            ->make()
            ->map(function ($portfolioItem) use ($bulletPoints, $images, $tags) {
                $portfolioItem['bullet_points'] = $bulletPoints->toArray();
                $portfolioItem['images'] = $images->toArray();
                $portfolioItem['tags'] = $tags->toArray();
                return $portfolioItem;
            })
            ->toArray();

        // Then
        AddPortfolioItems::partialMock()
            ->shouldReceive("handle")
            ->once()
            ->with($portfolioItems);

        // When
        $response = $this->post(route("add-portfolio-items"), [
            "portfolio_items" => $portfolioItems
        ]);

        // Then
        $response->assertOk();
    }

    /** @test */
    public function it_should_not_add_items_with_same_title()
    {
        // Given
        $portfolioItems = PortfolioItemFactory::new()
            ->count(2)
            ->make([
                "title_nl" => "Same title",
                "title_en" => "Zelfde titel",
            ])
            ->toArray();

        // When
        $response = $this->post(route("add-portfolio-items"), [
            "portfolio_items" => $portfolioItems
        ]);

        $response = $this->post(route("add-portfolio-items"), [
            "portfolio_items" => $portfolioItems
        ]);

        self::assertEquals(1, PortfolioItem::count());
    }

    /** @test */
    public function it_should_return_response_with_portfolio_items()
    {
        $url = route('all-portfolio-items');
        $response = $this->get($url);
        self::assertNotNull($response["meta"]["created_at"]);
        self::assertNotNull($response["payload"]["portfolio_items"]);
    }

    /** @test */
    public function it_should_return_response_with_error_message_when_failed_to_get_all_portfolio_items()
    {
        GetAllPortfolioItems::partialMock()->shouldReceive("handle")->andThrow(new \Exception("Failed to get all portfolio items"));
        $url = route('all-portfolio-items');
        $response = $this->get($url);
        self::assertNotNull($response["meta"]["created_at"]);
        self::assertNotNull($response["error"]["message"]);
        self::assertNotNull($response["error"]["code"]);
    }

    /** @test */
    public function it_should_return_response_with_portfolio_items_filtered_by_tag()
    {
        $url = route('all-portfolio-items', [
            "tag" => "Test Tag"
        ]);
        $response = $this->get($url);
        self::assertNotNull($response["payload"]["portfolio_items"]);
        self::assertNotNull($response["meta"]["created_at"]);
    }
}
