<?php

namespace App\Actions;

use App\Models\PortfolioItem;
use App\PortfolioManagement\Application\GetPortfolioItemsWithTag\GetPortfolioItemsWithTag;
use App\PortfolioManagement\Application\GetPortfolioItemsWithTag\GetPortfolioItemsWithTagInput;
use App\PortfolioManagement\Domain\Repositories\PortfolioItemRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\App;
use Lorisleiva\Actions\Concerns\AsAction;

class GetAllPortfolioItems
{
    use AsAction;

    public function handle()
    {
        return PortfolioItem::all()->sortBy('position');
    }

    public function asController(Request $request)
    {
        try {
            if ($tag = $request->query("tag"))
            {
                $useCase = new GetPortfolioItemsWithTag(App::make(PortfolioItemRepositoryInterface::class));
                $useCaseInput = new GetPortfolioItemsWithTagInput([
                    "tag" => $tag
                ]);

                $useCaseResult = $useCase->execute($useCaseInput);
                $portfolioItems = $useCaseResult->portfolioItems();
            } else {
                $portfolioItems = $this->handle();
            }

            $response["meta"]["created_at"] = time();
            $response["payload"]["portfolio_items"] = new LengthAwarePaginator($portfolioItems, $portfolioItems->count(), 3);

        } catch (\Exception $e)
        {
            $response["meta"]["created_at"] = time();
            $response["error"]["code"] = $e->getCode();
            $response["error"]["message"] = $e->getMessage();
        }

        return $response;
    }
}
