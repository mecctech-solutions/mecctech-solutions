<?php

namespace App\Actions;

use App\Services\CsvPortfolioItemsConverter;
use Illuminate\Http\JsonResponse;
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

    public function asController(Request $request): JsonResponse
    {
        try {
            $uploadedFile = $request->file('portfolio_items');
            
            if ($uploadedFile === null) {
                throw new \InvalidArgumentException('No file uploaded');
            }

            $path = $uploadedFile->getRealPath();
            
            if ($path === false) {
                throw new \RuntimeException('Could not get file path');
            }

            $this->handle($path);

            return response()->json([
                'meta' => [
                    'created_at' => time(),
                ],
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'meta' => [
                    'created_at' => time(),
                ],
                'error' => [
                    'code' => $e->getCode(),
                    'message' => $e->getMessage(),
                ],
            ], 500);
        }
    }
}
