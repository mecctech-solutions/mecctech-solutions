<?php


namespace App\PortfolioManagement\Presentation\Http\Api;


use App\PortfolioManagement\Application\GetAllPortfolioItems\GetAllPortfolioItems;
use App\PortfolioManagement\Application\GetAllPortfolioItems\GetAllPortfolioItemsInput;
use App\PortfolioManagement\Application\GetPortfolioItemsWithTag\GetPortfolioItemsWithTag;
use App\PortfolioManagement\Application\GetPortfolioItemsWithTag\GetPortfolioItemsWithTagInput;
use App\PortfolioManagement\Domain\PortfolioItems\PortfolioItemFactory;
use App\PortfolioManagement\Domain\Repositories\PortfolioItemRepositoryInterface;
use App\PortfolioManagement\Domain\Services\PortfolioManagementServiceInterface;
use App\PortfolioManagement\Infrastructure\Converters\Csv\PortfolioItems\PortfolioItemsConverter;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\App;
use PhpOffice\PhpSpreadsheet\IOFactory;

class PortfolioManagementController
{
    private PortfolioManagementServiceInterface $portfolioManagementService;

    public function __construct()
    {
        $this->portfolioManagementService = App::make(PortfolioManagementServiceInterface::class);
    }

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
            $response["payload"]["portfolio_items"] = new LengthAwarePaginator($portfolioItemsAsArray, $portfolioItems->count(), 9);

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

    public function addMultiplePortfolioItems(Request $request)
    {

        try {
            $portfolioItems = PortfolioItemFactory::multipleFromArray($request->input("portfolio_items"));
            $this->portfolioManagementService->addPortfolioItems(collect($portfolioItems));

            $response["meta"]["created_at"] = time();
        } catch (\Exception $e)
        {
            $response["meta"]["created_at"] = time();
            $response["error"]["code"] = $e->getCode();
            $response["error"]["message"] = $e->getMessage();
        }

        return $response;
    }

    public function importPortfolioItems(Request $request)
    {
        try {
            $uploadedFile = $request->file('portfolio_items');

            $portfolioItems = PortfolioItemsConverter::toEntity($uploadedFile);
            $this->portfolioManagementService->addPortfolioItems(collect($portfolioItems));

            $response["meta"]["created_at"] = time();

        } catch (\Exception $e)
        {
            $response["meta"]["created_at"] = time();
            $response["error"]["code"] = $e->getCode();
            $response["error"]["message"] = $e->getMessage();
        }


        return $response;
    }
}
