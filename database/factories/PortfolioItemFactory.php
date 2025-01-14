<?php

namespace Database\Factories;

use App\Models\PortfolioItem;
use Illuminate\Database\Eloquent\Factories\Factory;

class PortfolioItemFactory extends Factory
{
    protected $model = PortfolioItem::class;

    public function definition(): array
    {
        return [
            "title_nl" => $this->faker->sentence,
            "title_en" => $this->faker->sentence,
            "main_image_url" => $this->faker->imageUrl(),
            "description_nl" => $this->faker->paragraph,
            "description_en" => $this->faker->paragraph,
            "website_url" => $this->faker->url,
            "position" => $this->faker->numberBetween(1, 100),
        ];
    }
}
