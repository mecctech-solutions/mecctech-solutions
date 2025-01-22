<?php

namespace Database\Factories;

use App\Models\Tag;
use Illuminate\Database\Eloquent\Factories\Factory;

class TagFactory extends Factory
{
    protected $model = Tag::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->word,
            'visible' => $this->faker->boolean,
            'position' => $this->faker->numberBetween(1, 100),
        ];
    }
}
