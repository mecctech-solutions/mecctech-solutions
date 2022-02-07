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
                $tags = TagFactory::multiple(5);
            }

            $portfolioItem = new PortfolioItem($title, $mainImage, $description, $websiteUrl, $images, $tags);
            $result->push($portfolioItem);
        }

        return $result;
    }
}
