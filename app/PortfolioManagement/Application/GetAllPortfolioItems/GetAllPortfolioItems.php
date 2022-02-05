<?php


namespace App\PortfolioManagement\Application\GetAllPortfolioItems;

use App\PortfolioManagement\Domain\Repositories\PortfolioItemRepositoryInterface;

class GetAllPortfolioItems implements GetAllPortfolioItemsInterface
{
    private PortfolioItemRepositoryInterface $portfolioItemRepository;

    /**
     * GetAllPortfolioItems constructor.
     */
    public function __construct(PortfolioItemRepositoryInterface $portfolioItemRepository)
    {
        $this->portfolioItemRepository = $portfolioItemRepository;
    }

    /**
     * @inheritDoc
     */
    public function execute(GetAllPortfolioItemsInput $input): GetAllPortfolioItemsResult
    {
        $portfolioItems = $this->portfolioItemRepository->all();
        return new GetAllPortfolioItemsResult($portfolioItems);
    }
}
