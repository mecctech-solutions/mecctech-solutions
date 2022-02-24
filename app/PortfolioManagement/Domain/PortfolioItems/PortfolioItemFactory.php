<?php

namespace App\PortfolioManagement\Domain\PortfolioItems;

use Illuminate\Support\Collection;
use Faker;

class PortfolioItemFactory
{

    public static function create(int $amount, array $attributes = []): Collection
    {
        $faker = Faker\Factory::create();
        $result = collect();

        for ($i = 0; $i < $amount; $i++)
        {
            $title = $faker->title;
            $description = $faker->text;
            $mainImage = ImageFactory::placeholder();
            $websiteUrl = $faker->url;
            $images = ImageFactory::placeholders(5);

            if (array_key_exists("tags", $attributes))
            {
                $tags = collect($attributes["tags"]);
            } else {
                $tags = TagFactory::multiple(2);
            }

            $portfolioItem = new PortfolioItem($title, $mainImage, $description, $websiteUrl, $images, $tags);
            $result->push($portfolioItem);
        }

        return $result;
    }

    public static function fromArray(array $portfolioItemAsArray): PortfolioItem
    {
        $title = $portfolioItemAsArray["title"];
        $description = $portfolioItemAsArray["description"];
        $websiteUrl = $portfolioItemAsArray["website_url"];
        $mainImageUrl = $portfolioItemAsArray["main_image_url"];
        $mainImage = new Image($mainImageUrl);

        $images = collect(array_map(function ($image) {
                return new Image($image["url"]);
            }, $portfolioItemAsArray["images"]));

        $tags = collect($portfolioItemAsArray["tags"]);

        return new PortfolioItem($title, $mainImage, $description, $websiteUrl, $images, $tags);
    }

    public static function multipleFromArray(array $portfolioItemsAsArray)
    {
        $portfolioItems = [];

        foreach ($portfolioItemsAsArray as $portfolioItemAsArray)
        {
            $portfolioItems[] = self::fromArray($portfolioItemAsArray);
        }

        return $portfolioItems;
    }
}
