<?php

namespace App\PortfolioManagement\Infrastructure\Persistence\Eloquent\PortfolioItems\Mappers;

use App\PortfolioManagement\Domain\PortfolioItems\Description;
use App\PortfolioManagement\Domain\PortfolioItems\Image;
use App\PortfolioManagement\Domain\PortfolioItems\PortfolioItem;
use App\PortfolioManagement\Domain\PortfolioItems\Title;
use App\PortfolioManagement\Infrastructure\Persistence\Eloquent\PortfolioItems\EloquentImage;
use App\PortfolioManagement\Infrastructure\Persistence\Eloquent\PortfolioItems\EloquentPortfolioItem;
use App\PortfolioManagement\Infrastructure\Persistence\Eloquent\PortfolioItems\EloquentTag;
use phpDocumentor\Reflection\DocBlock\TagFactory;

class PortfolioItemMapper
{
    public static function toEntity(?EloquentPortfolioItem $model): ?PortfolioItem
    {
        if (! $model)
        {
            return null;
        }

        $title = new Title($model->title_nl, $model->title_en);
        $mainImage = new Image($model->main_image_url);
        $description = new Description($model->description_nl, $model->description_en);
        $websiteUrl = $model->website_url;
        $tagModels = $model->tags;

        $tags = collect();
        foreach ($tagModels as $tagModel)
        {
            $attributes = $tagModel->attributesToArray();
            $tags->push($attributes["name"]);
        }

        $imageModels = $model->images;

        $images = collect();

        foreach ($imageModels as $imageModel)
        {
            $images->push(new Image($imageModel->url));
        }

        return new PortfolioItem($title, $mainImage, $description, $websiteUrl, $images, $tags);
    }

    public static function toEloquent(PortfolioItem $portfolioItem): EloquentPortfolioItem
    {
        $model = new EloquentPortfolioItem();
        $model->title_en = $portfolioItem->title()->english();
        $model->title_nl = $portfolioItem->title()->dutch();
        $model->main_image_url = $portfolioItem->mainImage()->url();
        $model->description_en = $portfolioItem->description()->english();
        $model->description_nl = $portfolioItem->description()->dutch();
        $model->website_url = $portfolioItem->websiteUrl();

        foreach ($portfolioItem->tags() as $tag)
        {
            $model->tags[] = new EloquentTag([
                "name" => $tag
            ]);
        }

        foreach ($portfolioItem->images() as $image)
        {
            $model->images[] = new EloquentImage([
                "url" => $image->url()
            ]);
        }

        return $model;
    }
}
