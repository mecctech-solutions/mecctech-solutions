<?php

namespace Tests\Unit\PortfolioManagement;

use App\PortfolioManagement\Domain\PortfolioItems\Description;
use App\PortfolioManagement\Domain\PortfolioItems\Image;
use App\PortfolioManagement\Domain\PortfolioItems\PortfolioItem;
use App\PortfolioManagement\Domain\PortfolioItems\PortfolioItemFactory;
use App\PortfolioManagement\Domain\PortfolioItems\Title;
use Illuminate\Support\Collection;

class ReturnConstantPortfolioItemRepository implements \App\PortfolioManagement\Domain\Repositories\PortfolioItemRepositoryInterface
{

    private Collection $portfolioItems;

    public function __construct()
    {
        $attributes = [
            "tags" => [
                "Constant Tag 1"
            ]
        ];

        $this->portfolioItems = PortfolioItemFactory::create(50, $attributes);
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

    public function find(Title $title, Image $mainImage, Description $description, string $websiteUrl): ?PortfolioItem
    {
        return $this->portfolioItems->first();
    }
}
