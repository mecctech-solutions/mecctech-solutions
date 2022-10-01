<?php

namespace App\PortfolioManagement\Domain\PortfolioItems;

use Faker;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

class PortfolioItemFactory
{

    public static function create(int $amount, array $attributes = []): Collection
    {
        $faker = Faker\Factory::create();
        $result = collect();

        for ($i = 0; $i < $amount; $i++)
        {

            if (array_key_exists("title_en", $attributes))
            {
                $titleEn = $attributes["title_en"];
            } else {
                $titleEn = $faker->sentence;
            }

            if (array_key_exists("title_nl", $attributes))
            {
                $titleNl = $attributes["title_nl"];
            } else {
                $titleNl = $faker->sentence;
            }

            $title = new Title($titleEn, $titleNl);
            $description = new Description($faker->text, $faker->text);
            $mainImage = ImageFactory::placeholder();
            $websiteUrl = $faker->url;
            $images = ImageFactory::placeholders(5);

            if (array_key_exists("tags", $attributes))
            {
                $tags = collect($attributes["tags"]);
            } else {
                $tags = TagFactory::multiple(2);
            }

            $bulletPoints = Arr::get($attributes, 'bullet_points', BulletPointFactory::multiple(rand(1, 10)));
            $portfolioItem = new PortfolioItem($title, $mainImage, $description, $websiteUrl, $images, $tags, $bulletPoints);
            $result->push($portfolioItem);
        }

        return $result;
    }

    public static function fromArray(array $portfolioItemAsArray): PortfolioItem
    {
        $title = new Title($portfolioItemAsArray["title"]["dutch"], $portfolioItemAsArray["title"]["english"]);
        $description = new Description($portfolioItemAsArray["description"]["dutch"], $portfolioItemAsArray["description"]["english"]);
        $websiteUrl = $portfolioItemAsArray["website_url"];
        $mainImageUrl = $portfolioItemAsArray["main_image"]["url"];
        $mainImage = new Image($mainImageUrl);

        $images = collect(array_map(function ($image) {
                return new Image($image["url"]);
            }, $portfolioItemAsArray["images"]));

        $tags = collect($portfolioItemAsArray["tags"]);
        $bulletPoints = collect(array_map(function ($bulletPoint) {
            return new BulletPoint($bulletPoint["dutch"], Arr::get($bulletPoint, "english"));
        }, $portfolioItemAsArray["bullet_points"]));

        return new PortfolioItem($title, $mainImage, $description, $websiteUrl, $images, $tags, $bulletPoints);
    }

    public static function multipleFromArray(array $portfolioItemsAsArray): Collection
    {
        $portfolioItems = collect();
        foreach ($portfolioItemsAsArray as $portfolioItemAsArray)
        {
            $portfolioItems->push(self::fromArray($portfolioItemAsArray));
        }

        return $portfolioItems;
    }
}
