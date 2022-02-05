<?php


namespace App\PortfolioManagement\Application\GetAllPortfolioItems;


interface GetAllPortfolioItemsInterface
{
    /**
     * @param GetAllPortfolioItemsInput $input
     * @return GetAllPortfolioItemsResult
     */
    public function execute(GetAllPortfolioItemsInput $input): GetAllPortfolioItemsResult;
}
