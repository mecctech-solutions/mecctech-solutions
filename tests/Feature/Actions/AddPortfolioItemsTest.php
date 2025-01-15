<?php

namespace Tests\Feature\Actions;

use App\Actions\AddPortfolioItems;
use App\Models\BulletPoint;
use App\Models\Image;
use App\Models\PortfolioItem;
use App\Models\Tag;
use App\PortfolioManagement\Domain\Repositories\PortfolioItemRepositoryInterface;
use Database\Factories\PortfolioItemFactory;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\App;
use Tests\TestCase;
use Tests\Unit\PortfolioManagement\DummyPortfolioItemRepository;

class AddPortfolioItemsTest extends TestCase
{

    /** @test */
    public function it_should_add_portfolio_items_with_relations()
    {
        // Given
        $bulletPoints = BulletPoint::factory()->count(3)->make();
        $images = Image::factory()->count(3)->make();
        $tags = Tag::factory()->count(3)->make();
        $portfolioItems = PortfolioItemFactory::new()
            ->count(20)
            ->make()
            ->map(function ($portfolioItem) use ($bulletPoints, $images, $tags) {
                $portfolioItem['bulletPoints'] = $bulletPoints->toArray();
                $portfolioItem['images'] = $images->toArray();
                $portfolioItem['tags'] = $tags->toArray();
                return $portfolioItem;
            })
            ->toArray();

        // When
        AddPortfolioItems::run($portfolioItems);

        // Then
        $expectedPortfolioItems = collect($portfolioItems)->map(function ($item) {
            unset($item['bulletPoints'], $item['images'], $item['tags']); // Relationships not in the database
            return $item;
        })->toArray();

        $actualPortfolioItems = PortfolioItem::query()
            ->select(['title_nl', 'title_en', 'main_image_url', 'description_nl', 'description_en', 'website_url', 'position'])
            ->get()
            ->toArray();

        $expectedTags = collect($portfolioItems)->map(function ($item) {
            return collect($item['tags'])->pluck('name')->toArray();
        })->flatten()->unique()->toArray();

        $actualTags = Tag::query()->pluck('name')->toArray();

        // Then
        self::assertEquals($expectedPortfolioItems, $actualPortfolioItems);
        self::assertEquals($expectedTags, $actualTags);
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
