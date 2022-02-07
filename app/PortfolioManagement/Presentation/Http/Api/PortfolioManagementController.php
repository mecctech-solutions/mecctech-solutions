<?php


namespace App\PortfolioManagement\Presentation\Http\Api;


use App\PortfolioManagement\Application\GetAllPortfolioItems\GetAllPortfolioItems;
use App\PortfolioManagement\Application\GetAllPortfolioItems\GetAllPortfolioItemsInput;
use App\PortfolioManagement\Application\GetPortfolioItemsWithTag\GetPortfolioItemsWithTag;
use App\PortfolioManagement\Application\GetPortfolioItemsWithTag\GetPortfolioItemsWithTagInput;
use App\PortfolioManagement\Domain\Repositories\PortfolioItemRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class PortfolioManagementController
{
    public function getAllPortfolioItems(Request $request): array
    {
        try {
            $useCase = new GetAllPortfolioItems(App::make(PortfolioItemRepositoryInterface::class));
            $useCaseInput = new GetAllPortfolioItemsInput();
            $useCaseResult = $useCase->execute($useCaseInput);
            $portfolioItems = $useCaseResult->portfolioItems();

            $portfolioItemsAsArray = [];
            foreach ($portfolioItems as $portfolioItem)
            {
                $portfolioItemsAsArray[] = $portfolioItem->asArray();
            }

            $response["meta"]["created_at"] = time();
            $response["payload"]["portfolio_items"] = $portfolioItemsAsArray;

        } catch (\Exception $e)
        {
            $response["meta"]["created_at"] = time();
            $response["error"]["code"] = $e->getCode();
            $response["error"]["message"] = $e->getMessage();
        }

        return $response;
    }

    public function getPortfolioItemsWithTag(Request $request)
    {
        try {
            $useCase = new GetPortfolioItemsWithTag(App::make(PortfolioItemRepositoryInterface::class));
            $tag = $request->input("tag");
            $useCaseInput = new GetPortfolioItemsWithTagInput([
                "tag" => $tag
            ]);

            $useCaseResult = $useCase->execute($useCaseInput);

            $portfolioItems = $useCaseResult->portfolioItems();

            $portfolioItemsAsArray = [];
            foreach ($portfolioItems as $portfolioItem)
            {
                $portfolioItemsAsArray[] = $portfolioItem->asArray();
            }

            $response["meta"]["created_at"] = time();
            $response["payload"]["portfolio_items"] = $portfolioItemsAsArray;

        } catch (\Exception $e)
        {
            $response["meta"]["created_at"] = time();
            $response["error"]["code"] = $e->getCode();
            $response["error"]["message"] = $e->getMessage();
        }

        return $response;
    }
}
