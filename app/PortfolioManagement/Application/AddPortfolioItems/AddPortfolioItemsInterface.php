<?php


namespace App\PortfolioManagement\Application\AddPortfolioItems;


interface AddPortfolioItemsInterface
{
    /**
     * @param AddPortfolioItemsInput $input
     * @return AddPortfolioItemsResult
     */
    public function execute(AddPortfolioItemsInput $input): AddPortfolioItemsResult;
}
