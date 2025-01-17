<?php

namespace Database\Factories;

use App\Models\ContactRequest;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class ContactRequestFactory extends Factory
{
    protected $model = ContactRequest::class;

    public function definition(): array
    {
        return [
            'customer_number' => $this->faker->word(),
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'email' => $this->faker->unique()->safeEmail(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'phone_number' => $this->faker->phoneNumber(),
        ];
    }
}
