<?php

namespace Database\Factories;

use App\Models\BulletPoint;
use App\Models\CaseStudy;
use App\Models\Image;
use App\Models\PortfolioItem;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Factories\Factory;

class PortfolioItemFactory extends Factory
{
    protected $model = PortfolioItem::class;

    public function definition(): array
    {
        return [
            'title_nl' => fake()->sentence,
            'title_en' => fake()->sentence,
            'main_image_url' => 'images/placeholder.png',
            'description_nl' => fake()->paragraph,
            'description_en' => fake()->paragraph,
            'website_url' => fake()->url,
            'visible' => true,
        ];
    }

    public function withTags(array $attributes, int $count = 1): static
    {
        return $this->afterCreating(function (PortfolioItem $portfolioItem) use ($attributes, $count) {
            $tags = Tag::factory()->count($count)->create($attributes);
            $portfolioItem->tags()->sync($tags->pluck('id')->toArray());
        });
    }

    public function withImages(int $count = 1)
    {
        return $this->afterCreating(function (PortfolioItem $portfolioItem) use ($count) {
            Image::factory()->count($count)->create(['portfolio_item_id' => $portfolioItem->id]);
        });
    }

    public function withBulletPoints(int $count = 1)
    {
        return $this->afterCreating(function (PortfolioItem $portfolioItem) use ($count) {
            BulletPoint::factory()->count($count)->create(['portfolio_item_id' => $portfolioItem->id]);
        });
    }

    public function configure(): static
    {
        return $this->afterCreating(function (PortfolioItem $portfolioItem) {
            BulletPoint::factory()->count(3)->create(['portfolio_item_id' => $portfolioItem->id]);

            Image::factory()->count(3)->create(['portfolio_item_id' => $portfolioItem->id]);

            CaseStudy::factory()->create(['portfolio_item_id' => $portfolioItem->id]);

            $tags = Tag::factory()->count(3)->create();
            $portfolioItem->tags()->sync($tags->pluck('id')->toArray());
        });
    }
}
