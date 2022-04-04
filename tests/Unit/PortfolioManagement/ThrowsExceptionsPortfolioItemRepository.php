<?php

namespace Tests\Unit\PortfolioManagement;

use App\PortfolioManagement\Domain\PortfolioItems\Description;
use App\PortfolioManagement\Domain\PortfolioItems\Image;
use App\PortfolioManagement\Domain\PortfolioItems\PortfolioItem;
use App\PortfolioManagement\Domain\PortfolioItems\Title;
use Illuminate\Support\Collection;

class ThrowsExceptionsPortfolioItemRepository implements \App\PortfolioManagement\Domain\Repositories\PortfolioItemRepositoryInterface
{

    public function all(): Collection
    {
        throw new \Exception("Exception For Testing Purposes");
    }

    public function add(PortfolioItem $portfolioItem): void
    {
        throw new \Exception("Exception For Testing Purposes");
    }

    public function addMultiple(Collection $portfolioItems): void
    {
        throw new \Exception("Exception For Testing Purposes");
    }

    public function find(Title $title, Image $mainImage, Description $description, string $websiteUrl): ?PortfolioItem
    {
        throw new \Exception("Exception For Testing Purposes");
    }
}
