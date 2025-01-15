<?php

namespace App\Actions;

use App\Models\BulletPoint;
use App\Models\Image;
use App\Models\PortfolioItem;
use App\Models\Tag;
use Illuminate\Http\Request;
use Lorisleiva\Actions\Concerns\AsAction;

class AddPortfolioItems
{
    use AsAction;

    /**
     * @param  array $portfolioItems
     * @return void
     */
    public function handle(array $portfolioItems)
    {
        $portfolioItems = collect($portfolioItems);

        $portfolioItems->each(function (array $portfolioItem) {
            $newPortfolioItem = PortfolioItem::create([
                "title_nl" => $portfolioItem['title_nl'],
                "title_en" => $portfolioItem['title_en'],
                "description_nl" => $portfolioItem['description_nl'],
                "description_en" => $portfolioItem['description_en'],
                "position" => $portfolioItem['position'],
                "website_url" => $portfolioItem['website_url'],
                "main_image_url" => $portfolioItem['main_image_url'],
            ]);

            collect($portfolioItem['bulletPoints'])->each(function ($bulletPoint) use ($newPortfolioItem) {
                BulletPoint::create([
                    "text_nl" => $bulletPoint['text_nl'],
                    "text_en" => $bulletPoint['text_en'],
                    "portfolio_item_id" => $newPortfolioItem['id'],
                ]);
            });

            collect($portfolioItem['images'])->each(function ($image) use ($newPortfolioItem) {
                Image::create([
                    "url" => $image['url'],
                    "portfolio_item_id" => $newPortfolioItem['id'],
                ]);
            });

            collect($portfolioItem['tags'])->each(function ($tag) use ($newPortfolioItem) {
                $tag = Tag::firstOrCreate($tag);
                $newPortfolioItem->tags()->attach($tag->id);
            });
        });
    }

    public function asController(Request $request)
    {
        $this->handle();
    }
}
