<?php

namespace Database\Seeders;

use App\Models\PortfolioItem;
use Illuminate\Database\Seeder;

class PortfolioItemSeeder extends Seeder
{
    public function run(): void
    {
        PortfolioItem::factory()
            ->count(10)
            ->configure()
            ->create();
    }
}
