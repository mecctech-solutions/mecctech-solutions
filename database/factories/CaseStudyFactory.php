<?php

namespace Database\Factories;

use App\Models\CaseStudy;
use App\Models\PortfolioItem;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CaseStudyFactory extends Factory
{
    protected $model = CaseStudy::class;

    public function definition(): array
    {
        $titleNl = fake()->sentence();

        return [
            'portfolio_item_id' => PortfolioItem::factory(),
            'title_nl' => $titleNl,
            'title_en' => fake()->sentence(),
            'content_nl' => fake()->paragraphs(3, true),
            'content_en' => fake()->paragraphs(3, true),
            'slug' => Str::slug($titleNl),
        ];
    }
}
