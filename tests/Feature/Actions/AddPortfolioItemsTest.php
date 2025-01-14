<?php

namespace Tests\Feature\Actions;

use App\Models\PortfolioItem;
use App\PortfolioManagement\Domain\PortfolioItems\PortfolioItemFactory;
use App\PortfolioManagement\Domain\Repositories\PortfolioItemRepositoryInterface;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\App;
use Tests\TestCase;
use Tests\Unit\PortfolioManagement\DummyPortfolioItemRepository;

class AddPortfolioItemsTest extends TestCase
{

    /** @test */
    public function it_should_add_portfolio_items()
    {
        // Given
        $portfolioItems = \Database\Factories\PortfolioItemFactory::new()->count(20)->make();

        // When
        \App\Actions\AddPortfolioItems::run($portfolioItems);

        // Then
        self::assertEquals($portfolioItems->toArray(), PortfolioItem::all()->toArray());
    }

    /** @test */
    public function it_should_be_able_to_call_the_route()
    {
        // Given
        $portfolioItems = PortfolioItemFactory::create(1);

        App::bind(PortfolioItemRepositoryInterface::class, DummyPortfolioItemRepository::class);

        // When
        $response = $this->post(route("add-portfolio-items"), [
            "portfolio_items" => $portfolioItems->toArray()
        ]);

        $response->assertStatus(200);
    }

    /** @test */
    public function it_should_be_able_to_call_the_route_for_importing_portfolio_items()
    {
        // Given
        $url = route("import-portfolio-items");

        // When
        $response = $this->post($url, [
            "portfolio_items" => UploadedFile::fake()->create(1)
        ]);

        $response->assertStatus(200);
    }

    /** @test */
    public function it_should_not_add_items_with_same_title()
    {
        // Given
        $portfolioItems = PortfolioItemFactory::create(1, [
            "title_en" => "Test Title",
            "title_nl" => "Test Titel"
        ]);

        $portfolioItemRepository = new DummyPortfolioItemRepository();
        $this->app->instance(PortfolioItemRepositoryInterface::class, $portfolioItemRepository);

        // When
        $response = $this->post(route("add-portfolio-items"), [
            "portfolio_items" => $portfolioItems->toArray()
        ]);

        $response = $this->post(route("add-portfolio-items"), [
            "portfolio_items" => $portfolioItems->toArray()
        ]);

        self::assertEquals(1, $portfolioItemRepository->all()->count());
    }
}
