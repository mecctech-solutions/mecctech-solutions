<?php

namespace App\PortfolioManagement\Infrastructure\Persistence\Eloquent\PortfolioItems\Mappers;

use App\PortfolioManagement\Domain\PortfolioItems\Image;
use App\PortfolioManagement\Domain\PortfolioItems\PortfolioItem;
use App\PortfolioManagement\Infrastructure\Persistence\Eloquent\PortfolioItems\EloquentImage;
use App\PortfolioManagement\Infrastructure\Persistence\Eloquent\PortfolioItems\EloquentPortfolioItem;
use App\PortfolioManagement\Infrastructure\Persistence\Eloquent\PortfolioItems\EloquentTag;
use phpDocumentor\Reflection\DocBlock\TagFactory;

class PortfolioItemMapper
{
    public static function toEntity(EloquentPortfolioItem $model): PortfolioItem
    {
        $title = $model->title;
        $mainImage = new Image($model->main_image_url);
        $description = $model->description;
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
        $model->title = $portfolioItem->title();
        $model->main_image_url = $portfolioItem->mainImage()->url();
        $model->description = $portfolioItem->description();
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
