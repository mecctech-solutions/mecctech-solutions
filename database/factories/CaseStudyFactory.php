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
        $titleNl = $this->faker->sentence();

        return [
            'portfolio_item_id' => PortfolioItem::factory(),
            'title_nl' => $titleNl,
            'title_en' => $this->faker->sentence(),
            'content_nl' => $this->faker->paragraphs(3, true),
            'content_en' => $this->faker->paragraphs(3, true),
            'slug' => Str::slug($titleNl),
        ];
    }
}
