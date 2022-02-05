<?php


namespace App\PortfolioManagement\Application\GetAllPortfolioItems;


use Illuminate\Support\Collection;

final class GetAllPortfolioItemsResult
{
    private Collection $portfolioItems;

    public function __construct(Collection $portfolioItems)
    {
        $this->portfolioItems = $portfolioItems;
    }

    public function portfolioItems(): Collection
    {
        return $this->portfolioItems;
    }
}
