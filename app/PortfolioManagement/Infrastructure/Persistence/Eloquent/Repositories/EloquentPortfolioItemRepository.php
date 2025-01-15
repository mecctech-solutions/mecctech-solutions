<?php

namespace App\PortfolioManagement\Infrastructure\Persistence\Eloquent\Repositories;

use App\PortfolioManagement\Domain\PortfolioItems\Description;
use App\PortfolioManagement\Domain\PortfolioItems\Image;
use App\PortfolioManagement\Domain\PortfolioItems\PortfolioItem;
use App\PortfolioManagement\Domain\PortfolioItems\Title;
use App\PortfolioManagement\Domain\Repositories\PortfolioItemRepositoryInterface;
use App\PortfolioManagement\Infrastructure\Persistence\Eloquent\PortfolioItems\EloquentPortfolioItem;
use App\PortfolioManagement\Infrastructure\Persistence\Eloquent\PortfolioItems\Mappers\PortfolioItemMapper;
use Illuminate\Support\Collection;

class EloquentPortfolioItemRepository implements PortfolioItemRepositoryInterface
{

    public function all(): Collection
    {
        $result = collect();
        $models = EloquentPortfolioItem::all()->sortBy("position");

        foreach ($models as $model)
        {
            $portfolioItem = PortfolioItemMapper::toEntity($model);
            $result->push($portfolioItem);
        }

        return $result;
    }

    public function add(PortfolioItem $portfolioItem): void
    {
        $model = PortfolioItemMapper::toEloquent($portfolioItem);
        $model->save();
    }

    public function addMultiple(Collection $portfolioItems): void
    {
        foreach ($portfolioItems as $portfolioItem)
        {
            $this->add($portfolioItem);
        }
    }


    public function find(Title $title, Image $mainImage, Description $description, string $websiteUrl): ?PortfolioItem
    {
        $model = PortfolioItem::where([
            "title_en" => $title->english(),
            "title_nl" => $title->dutch(),
            "main_image_url" => $mainImage->url(),
            "description_en" => $description->english(),
            "description_nl" => $description->dutch(),
            "website_url" => $websiteUrl
        ])->first();

        return PortfolioItemMapper::toEntity($model);
    }
}
