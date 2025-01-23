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
            'name' => $this->faker->name,
            'job_title' => $this->faker->jobTitle,
            'client_id' => Client::factory(),
            'position' => $this->faker->numberBetween(1, 10),
            'text_nl' => $this->faker->paragraph,
            'text_en' => $this->faker->paragraph,
            'image_url' => 'images/testimonials/placeholder.jpg',
        ];
    }
}
