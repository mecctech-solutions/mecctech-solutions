<?php

namespace Database\Factories;

use App\Enums\SettingKey;
use App\Models\Setting;
use Illuminate\Database\Eloquent\Factories\Factory;

class SettingFactory extends Factory
{
    protected $model = Setting::class;

    public function definition(): array
    {
        return [
            'key' => SettingKey::PORTFOLIO_ITEMS_PER_PAGE->value,
            'value' => fake()->numberBetween(1, 20),
        ];
    }
} 