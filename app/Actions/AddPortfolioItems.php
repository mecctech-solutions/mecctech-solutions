<?php

namespace App\Actions;

use App\Models\PortfolioItem;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Lorisleiva\Actions\Concerns\AsAction;

class AddPortfolioItems
{
    use AsAction;

    /**
     * @param  Collection<PortfolioItem> $portfolioItems
     * @return void
     */
    public function handle(Collection $portfolioItems)
    {
        $portfolioItems->each(function (PortfolioItem $portfolioItem) {
            PortfolioItem::create([
                "title_nl" => $portfolioItem->title_nl,
                "title_en" => $portfolioItem->title_en,
                "description_nl" => $portfolioItem->description_nl,
                "description_en" => $portfolioItem->description_en,
                "position" => $portfolioItem->position,
                "website_url" => $portfolioItem->website_url,
                "main_image_url" => $portfolioItem->main_image_url,
                "tags" => $portfolioItem->tags,
                "bullet_points" => $portfolioItem->bulletPoints,
            ]);
        });
    }

    public function asController(Request $request)
    {
        $this->handle();
    }
}
