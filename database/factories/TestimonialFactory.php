<?php

namespace Database\Factories;

use App\Models\Client;
use App\Models\Testimonial;
use Illuminate\Database\Eloquent\Factories\Factory;

class TestimonialFactory extends Factory
{
    protected $model = Testimonial::class;

    public function definition(): array
    {
        return [
            'name' => fake()->name,
            'job_title_en' => fake()->jobTitle,
            'job_title_nl' => fake()->jobTitle,
            'client_id' => Client::factory(),
            'position' => fake()->numberBetween(1, 10),
            'text_nl' => fake()->paragraph,
            'text_en' => fake()->paragraph,
            'image_url' => 'images/placeholder.png',
        ];
    }
}
