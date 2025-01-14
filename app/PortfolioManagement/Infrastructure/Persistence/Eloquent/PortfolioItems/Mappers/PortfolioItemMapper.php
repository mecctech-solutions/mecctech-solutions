<?php

namespace App\PortfolioManagement\Infrastructure\Persistence\Eloquent\PortfolioItems\Mappers;

use App\PortfolioManagement\Domain\PortfolioItems\BulletPoint;
use App\PortfolioManagement\Domain\PortfolioItems\Description;
use App\PortfolioManagement\Domain\PortfolioItems\Image;
use App\PortfolioManagement\Domain\PortfolioItems\PortfolioItem;
use App\PortfolioManagement\Domain\PortfolioItems\Title;
use App\PortfolioManagement\Infrastructure\Persistence\Eloquent\PortfolioItems\EloquentBulletPoint;
use App\PortfolioManagement\Infrastructure\Persistence\Eloquent\PortfolioItems\EloquentImage;
use App\PortfolioManagement\Infrastructure\Persistence\Eloquent\PortfolioItems\EloquentPortfolioItem;
use App\PortfolioManagement\Infrastructure\Persistence\Eloquent\PortfolioItems\EloquentTag;

class PortfolioItemMapper
{
    public static function toEntity(?EloquentPortfolioItem $model): ?PortfolioItem
    {
        if (! $model)
        {
            return null;
        }

        $title = new Title($model->title_nl, $model->title_en);
        $mainImage = new Image($model->main_image_full_url);
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
            $images->push(new Image($imageModel->full_url));
        }

        $bulletPoints = collect();
        $bulletPointModels = $model->bulletPoints;

        foreach ($bulletPointModels as $bulletPointModel)
        {
            $bulletPoints->push(new BulletPoint($bulletPointModel->text_nl, $bulletPointModel->text_en));
        }

        return new PortfolioItem($title, $mainImage, $description, $websiteUrl, $images, $tags, $bulletPoints);
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

        foreach ($portfolioItem->bulletPoints() as $bulletPoint)
        {
            $model->bulletPoints[] = new EloquentBulletPoint([
                "text_en" => $bulletPoint->english(),
                "text_nl" => $bulletPoint->dutch(),
            ]);
        }

        return $model;
    }
}
