<?php


namespace App\PortfolioManagement\Application\GetPortfolioItemsWithTag;

use App\PortfolioManagement\Domain\PortfolioItems\PortfolioItem;
use App\PortfolioManagement\Domain\Repositories\PortfolioItemRepositoryInterface;

class GetPortfolioItemsWithTag implements GetPortfolioItemsWithTagInterface
{
    private PortfolioItemRepositoryInterface $portfolioItemRepository;

    /**
     * GetPortfolioItemsWithTag constructor.
     */
    public function __construct(PortfolioItemRepositoryInterface $portfolioItemRepository)
    {
        $this->portfolioItemRepository = $portfolioItemRepository;
    }

    /**
     * @inheritDoc
     */
    public function execute(GetPortfolioItemsWithTagInput $input): GetPortfolioItemsWithTagResult
    {
        $portfolioItems = $this->portfolioItemRepository->all()->filter(function (PortfolioItem $portfolioItem) use ($input){
            return $portfolioItem->hasTag($input->tag());
        });

        return new GetPortfolioItemsWithTagResult($portfolioItems);
    }
}
