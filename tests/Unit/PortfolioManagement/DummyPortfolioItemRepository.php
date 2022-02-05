<?php

namespace Tests\Unit\PortfolioManagement;

use App\PortfolioManagement\Domain\PortfolioItems\Image;
use App\PortfolioManagement\Domain\PortfolioItems\PortfolioItem;
use Illuminate\Support\Collection;

class DummyPortfolioItemRepository implements \App\PortfolioManagement\Domain\Repositories\PortfolioItemRepositoryInterface
{
    /**
     * @var Collection<PortfolioItem>
     */
    private Collection $portfolioItems;

    public function __construct()
    {
        $this->portfolioItems = collect();
    }

    public function all(): Collection
    {
        return collect($this->portfolioItems);
    }

    public function add(PortfolioItem $portfolioItem): void
    {
        $this->portfolioItems->push($portfolioItem);
    }

    public function addMultiple(Collection $portfolioItems): void
    {
        foreach ($portfolioItems as $portfolioItem)
        {
            $this->portfolioItems->push($portfolioItem);
        }
    }

    public function find(string $title, Image $mainImage, string $description, string $websiteUrl): ?PortfolioItem
    {
        foreach ($this->portfolioItems as $portfolioItem)
        {
            if ($portfolioItem->title() === $title && $portfolioItem->mainImage() === $mainImage && $portfolioItem->description() === $description && $portfolioItem->websiteUrl() === $websiteUrl)
            {
                return $portfolioItem;
            }
        }

        return null;
    }
}
