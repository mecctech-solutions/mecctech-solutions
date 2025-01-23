<?php

namespace Database\Seeders;

use App\Models\Client;
use Illuminate\Database\Seeder;

class ClientSeeder extends Seeder
{
    public function run(): void
    {
        Client::factory()
            ->count(10)
            ->hasTestimonials(2)
            ->create();
    }
} 