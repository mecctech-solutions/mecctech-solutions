<?php


namespace App\PortfolioManagement\Application\AddPortfolioItems;

use App\PortfolioManagement\Domain\PortfolioItems\PortfolioItemFactory;
use App\PortfolioManagement\Domain\Repositories\PortfolioItemRepositoryInterface;

class AddPortfolioItems implements AddPortfolioItemsInterface
{
    private PortfolioItemRepositoryInterface $portfolioItemRepository;

    /**
     * AddPortfolioItems constructor.
     */
    public function __construct(PortfolioItemRepositoryInterface $portfolioItemRepository)
    {
        $this->portfolioItemRepository = $portfolioItemRepository;
    }

    /**
     * @inheritDoc
     */
    public function execute(AddPortfolioItemsInput $input): AddPortfolioItemsResult
    {
        $portfolioItems = PortfolioItemFactory::multipleFromArray($input->portfolioItems());
        $this->portfolioItemRepository->addMultiple(collect($portfolioItems));

        return new AddPortfolioItemsResult();
    }
}
