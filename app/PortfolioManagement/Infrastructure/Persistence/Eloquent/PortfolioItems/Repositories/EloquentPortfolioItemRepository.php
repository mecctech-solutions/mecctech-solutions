<?php

namespace App\PortfolioManagement\Infrastructure\Persistence\Eloquent\PortfolioItems\Repositories;

use App\PortfolioManagement\Domain\PortfolioItems\Image;
use App\PortfolioManagement\Domain\PortfolioItems\PortfolioItem;
use App\PortfolioManagement\Domain\Repositories\PortfolioItemRepositoryInterface;
use App\PortfolioManagement\Infrastructure\Persistence\Eloquent\PortfolioItems\EloquentPortfolioItem;
use App\PortfolioManagement\Infrastructure\Persistence\Eloquent\PortfolioItems\Mappers\PortfolioItemMapper;
use Illuminate\Support\Collection;

class EloquentPortfolioItemRepository implements PortfolioItemRepositoryInterface
{

    public function all(): Collection
    {
        $result = collect();
        $models = EloquentPortfolioItem::all();

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

    public function find(string $title, Image $mainImage, string $description, string $websiteUrl): PortfolioItem
    {
        $model = EloquentPortfolioItem::where([
            "title" => $title,
            "main_image_url" => $mainImage->url(),
            "description" => $description,
            "website_url" => $websiteUrl
        ])->first();

        return PortfolioItemMapper::toEntity($model);
    }


}
