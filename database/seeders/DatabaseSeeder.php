<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create admin user first
        $this->call(UserSeeder::class);

        // Seed main content
        $this->call([
            ClientSeeder::class,
            TagSeeder::class,
            PortfolioItemSeeder::class,
            CaseStudySeeder::class,
        ]);
    }
}
