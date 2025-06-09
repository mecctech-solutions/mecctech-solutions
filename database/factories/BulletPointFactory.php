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
            'text_nl' => fake()->sentence(),
            'text_en' => fake()->sentence(),
            'position' => 1,
        ];
    }
}
