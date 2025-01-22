<?php

namespace Database\Seeders;

use App\PortfolioManagement\Domain\PortfolioItems\PortfolioItemFactory;
use App\PortfolioManagement\Infrastructure\Persistence\Eloquent\Repositories\EloquentPortfolioItemRepository;
use Illuminate\Database\Seeder;

class PortfolioItemsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $portfolioItemRepository = new EloquentPortfolioItemRepository;
        $portfolioItems = PortfolioItemFactory::create(10);
        $portfolioItemRepository->addMultiple($portfolioItems);
    }
}
