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
            'name' => $this->faker->company,
            'website_url' => $this->faker->url,
            'logo_url' => 'images/clients/placeholder.jpg',
            'position' => $this->faker->numberBetween(1, 10),
        ];
    }
} 