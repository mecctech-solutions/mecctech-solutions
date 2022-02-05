<?php


namespace App\PortfolioManagement\Application\GetPortfolioItemsWithTag;


interface GetPortfolioItemsWithTagInterface
{
    /**
     * @param GetPortfolioItemsWithTagInput $input
     * @return GetPortfolioItemsWithTagResult
     */
    public function execute(GetPortfolioItemsWithTagInput $input): GetPortfolioItemsWithTagResult;
}
