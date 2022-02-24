<?php

namespace App\PortfolioManagement\Infrastructure\Services;

use App\PortfolioManagement\Application\AddPortfolioItems\AddPortfolioItems;
use App\PortfolioManagement\Application\AddPortfolioItems\AddPortfolioItemsInput;
use App\PortfolioManagement\Domain\Repositories\PortfolioItemRepositoryInterface;
use Illuminate\Support\Collection;

class PortfolioManagementService implements \App\PortfolioManagement\Domain\Services\PortfolioManagementServiceInterface
{
    private PortfolioItemRepositoryInterface $portfolioItemRepository;

    public function __construct(PortfolioItemRepositoryInterface $portfolioItemRepository)
    {
        $this->portfolioItemRepository = $portfolioItemRepository;
    }

    public function addPortfolioItems(Collection $portfolioItems): void
    {
        $useCase = new AddPortfolioItems($this->portfolioItemRepository);
        $useCaseInput = new AddPortfolioItemsInput(["portfolio_items" => $portfolioItems->toArray()]);
        $useCaseResult = $useCase->execute($useCaseInput);
    }
}
