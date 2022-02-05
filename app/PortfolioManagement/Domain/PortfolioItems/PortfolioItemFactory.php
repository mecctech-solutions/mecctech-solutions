<?php

namespace App\PortfolioManagement\Domain\PortfolioItems;

use Illuminate\Support\Collection;
use Faker;

class PortfolioItemFactory
{

    public static function create(int $amount): Collection
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
            $tags = TagFactory::multiple(5);
            $portfolioItem = new PortfolioItem($title, $mainImage, $description, $websiteUrl, $images, $tags);
            $result->push($portfolioItem);
        }

        return $result;
    }
}
