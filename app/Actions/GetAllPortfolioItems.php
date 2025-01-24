<?php

namespace App\Actions;

use App\Data\PortfolioItemData;
use App\Models\PortfolioItem;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Lorisleiva\Actions\Concerns\AsAction;

class GetAllPortfolioItems
{
    use AsAction;

    /**
     * @return Collection<PortfolioItem>
     */
    public function handle(?string $tag = null): Collection
    {
        /** @phpstan-ignore-next-line  */
        $query = PortfolioItem::query()
            ->where('visible', true)
            ->with('images', 'tags', 'bulletPoints', 'caseStudy');

        if ($tag) {
            /** @phpstan-ignore-next-line  */
            $query->whereRelation('tags', 'name', $tag);
        }

        return $query->sorted()->get();
    }

    public function asController(Request $request)
    {
        try {
            $portfolioItems = $this->handle($request->query('tag'));

            $response['meta']['created_at'] = time();
            $response['payload']['portfolio_items'] = new LengthAwarePaginator(PortfolioItemData::collect($portfolioItems), $portfolioItems->count(), 3);

        } catch (\Exception $e) {
            $response['meta']['created_at'] = time();
            $response['error']['code'] = $e->getCode();
            $response['error']['message'] = $e->getMessage();
        }

        return $response;
    }
}
