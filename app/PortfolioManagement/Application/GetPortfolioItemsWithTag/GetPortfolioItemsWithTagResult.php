<?php


namespace App\PortfolioManagement\Application\GetPortfolioItemsWithTag;


use Illuminate\Support\Collection;

final class GetPortfolioItemsWithTagResult
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
