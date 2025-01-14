<?php

namespace App\Actions;

use App\PortfolioManagement\Domain\Services\PortfolioManagementServiceInterface;
use App\PortfolioManagement\Infrastructure\Converters\Csv\PortfolioItems\PortfolioItemsConverter;
use App\PortfolioManagement\Infrastructure\Exceptions\PortfolioItemsConverterOperationException;
use Illuminate\Http\Request;
use Lorisleiva\Actions\Concerns\AsAction;

class ImportPortfolioItems
{
    use AsAction;

    public function __construct(private PortfolioManagementServiceInterface $portfolioManagementService)
    {}

    /**
     * @throws PortfolioItemsConverterOperationException
     */
    public function handle(string $path): void
    {
        $portfolioItems = PortfolioItemsConverter::toEntity($path);
        $this->portfolioManagementService->addPortfolioItems(collect($portfolioItems));
    }

    public function asController(Request $request)
    {
        try {
            $uploadedFile = $request->file('portfolio_items');
            $path = $uploadedFile->getRealPath();
            $this->handle($path);
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
