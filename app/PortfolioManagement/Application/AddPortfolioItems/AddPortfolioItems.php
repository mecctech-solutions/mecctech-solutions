<?php


namespace App\PortfolioManagement\Application\AddPortfolioItems;

use App\PortfolioManagement\Domain\PortfolioItems\PortfolioItem;
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

        $portfolioItems->each(function (PortfolioItem $portfolioItem) {

            $existingPortfolioItem = $this->portfolioItemRepository->find($portfolioItem->title(), $portfolioItem->mainImage(), $portfolioItem->description(), $portfolioItem->websiteUrl());

            if (! $existingPortfolioItem)
            {
                $this->portfolioItemRepository->add($portfolioItem);
            }
        });

        return new AddPortfolioItemsResult();
    }
}
