<?php

namespace App\Actions;

use App\Services\CsvPortfolioItemsConverter;
use Illuminate\Http\Request;
use Lorisleiva\Actions\Concerns\AsAction;

class ImportPortfolioItems
{
    use AsAction;

    public function handle(string $path): void
    {
        $portfolioItems = CsvPortfolioItemsConverter::import($path);
        AddPortfolioItems::run($portfolioItems);
    }

    public function asController(Request $request)
    {
        try {
            $uploadedFile = $request->file('portfolio_items');
            $path = $uploadedFile->getRealPath();
            $this->handle($path);
            $response['meta']['created_at'] = time();

        } catch (\Exception $e) {
            $response['meta']['created_at'] = time();
            $response['error']['code'] = $e->getCode();
            $response['error']['message'] = $e->getMessage();
        }

        return $response;
    }
}
