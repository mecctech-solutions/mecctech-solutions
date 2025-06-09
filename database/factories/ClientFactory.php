<?php

namespace Database\Factories;

use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClientFactory extends Factory
{
    protected $model = Client::class;

    public function definition(): array
    {
        return [
            'name' => fake()->company,
            'website_url' => fake()->url,
            'logo_url' => 'images/placeholder.png',
            'position' => fake()->numberBetween(1, 10),
        ];
    }
}
