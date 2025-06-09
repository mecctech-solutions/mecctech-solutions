<?php

namespace App\Actions;

use App\Data\PortfolioItemData;
use App\Models\PortfolioItem;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Lorisleiva\Actions\Concerns\AsAction;

class GetAllPortfolioItems
{
    use AsAction;

    /**
     * @return Collection<int, PortfolioItem>
     */
    public function handle(?string $tag = null): Collection
    {
        $query = PortfolioItem::query()
            ->where('visible', true)
            ->with('images', 'tags', 'bulletPoints', 'caseStudy');

        if ($tag) {
            $query->whereRelation('tags', 'name', $tag);
        }

        return $query->sorted()->get();
    }

    public function asController(Request $request): JsonResponse
    {
        try {
            $portfolioItems = $this->handle($request->query('tag'));
            $portfolioItemsData = PortfolioItemData::collect($portfolioItems);

            return response()->json([
                'meta' => [
                    'created_at' => time(),
                ],
                'payload' => [
                    'portfolio_items' => new LengthAwarePaginator(
                        $portfolioItemsData,
                        $portfolioItems->count(),
                        3
                    ),
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
