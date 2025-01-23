<?php

namespace Database\Seeders;

use App\Models\CaseStudy;
use App\Models\PortfolioItem;
use Illuminate\Database\Seeder;

class CaseStudySeeder extends Seeder
{
    public function run(): void
    {
        // Create case studies for 30% of portfolio items
        PortfolioItem::all()->random(PortfolioItem::count() * 0.3)->each(function ($portfolioItem) {
            CaseStudy::factory()->create([
                'portfolio_item_id' => $portfolioItem->id
            ]);
        });
    }
} 