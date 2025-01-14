<?php

namespace Database\Factories;

use App\Models\BulletPoint;
use Illuminate\Database\Eloquent\Factories\Factory;

class BulletPointFactory extends Factory
{
    protected $model = BulletPoint::class;

    public function definition(): array
    {
        return [
            "content_nl" => $this->faker->sentence,
            "content_en" => $this->faker->sentence,
        ];
    }
}
