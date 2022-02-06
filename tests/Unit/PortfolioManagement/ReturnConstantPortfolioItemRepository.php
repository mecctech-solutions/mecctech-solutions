<?php

namespace Tests\Unit\PortfolioManagement;

use App\PortfolioManagement\Domain\PortfolioItems\Image;
use App\PortfolioManagement\Domain\PortfolioItems\PortfolioItem;
use App\PortfolioManagement\Domain\PortfolioItems\PortfolioItemFactory;
use Illuminate\Support\Collection;

class ReturnConstantPortfolioItemRepository implements \App\PortfolioManagement\Domain\Repositories\PortfolioItemRepositoryInterface
{

    private Collection $portfolioItems;

    public function __construct()
    {
        $this->portfolioItems = PortfolioItemFactory::create(50);
    }

    public function all(): Collection
    {
        return $this->portfolioItems;
    }

    public function add(PortfolioItem $portfolioItem): void
    {
    }

    public function addMultiple(Collection $portfolioItems): void
    {
    }

    public function find(string $title, Image $mainImage, string $description, string $websiteUrl): ?PortfolioItem
    {
        return $this->portfolioItems->first();
    }
}
