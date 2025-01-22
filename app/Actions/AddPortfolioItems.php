<?php

namespace App\Actions;

use App\Data\BulletPointData;
use App\Data\ImageData;
use App\Data\PortfolioItemData;
use App\Data\TagData;
use App\Models\BulletPoint;
use App\Models\Image;
use App\Models\PortfolioItem;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Lorisleiva\Actions\Concerns\AsAction;

class AddPortfolioItems
{
    use AsAction;

    /**
     * @param  Collection<PortfolioItemData>  $portfolioItems
     */
    public function handle(Collection $portfolioItems): void
    {
        $portfolioItems->each(function (PortfolioItemData $portfolioItem) {
            $existingPortfolioItem = PortfolioItem::where('title_nl', $portfolioItem->title_nl)
                ->orWhere('title_en', $portfolioItem->title_en)
                ->first();

            if ($existingPortfolioItem) {
                return;
            }

            $newPortfolioItem = PortfolioItem::create([
                'title_nl' => $portfolioItem->title_nl,
                'title_en' => $portfolioItem->title_en,
                'description_nl' => $portfolioItem->description_nl,
                'description_en' => $portfolioItem->description_en,
                'position' => $portfolioItem->position,
                'website_url' => $portfolioItem->website_url,
                'main_image_url' => $portfolioItem->main_image_url,
            ]);

            $portfolioItem->bullet_points->each(function (BulletPointData $bulletPoint) use ($newPortfolioItem) {
                BulletPoint::create([
                    'text_nl' => $bulletPoint->text_nl,
                    'text_en' => $bulletPoint->text_en,
                    'portfolio_item_id' => $newPortfolioItem->id,
                ]);
            });

            $portfolioItem->images->each(function (ImageData $image) use ($newPortfolioItem) {
                Image::create([
                    'url' => $image->url,
                    'portfolio_item_id' => $newPortfolioItem->id,
                ]);
            });

            $portfolioItem->tags->each(function (TagData $tag) use ($newPortfolioItem) {
                $tag = Tag::firstOrCreate([
                    'name' => $tag->name,
                ], [
                    'name' => $tag->name,
                    'visible' => $tag->visible,
                ]);
                $newPortfolioItem->tags()->attach($tag->id);
            });
        });
    }

    public function asController(Request $request)
    {
        try {
            $portfolioItems = $request->input('portfolio_items');
            $this->handle($portfolioItems);

            return response()->json([], 200);
        } catch (\Exception $e) {
            $response['meta']['created_at'] = time();
            $response['error']['code'] = $e->getCode();
            $response['error']['message'] = $e->getMessage();
        }

        return $response;
    }
}
