<?php

namespace App\PortfolioManagement\Domain\PortfolioItems;

use Faker;
use Illuminate\Support\Collection;

class TagFactory
{
    public static function single(): string
    {
        $faker = Faker\Factory::create();
        return $faker->name;
    }

    public static function multiple(int $amount): Collection
    {
        $result = collect();

        for ($i = 0; $i < $amount; $i++)
        {
            $tag = self::single();
            $result->push($tag);
        }

        return $result;
    }

}
