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
            PortfolioItemSeeder::class,
            BlogPostSeeder::class,
        ]);

        // Seed the outreach module (templates before prospects: attempts snapshot templates)
        $this->call([
            OutreachTemplateSeeder::class,
            ProspectSeeder::class,
        ]);
    }
}
