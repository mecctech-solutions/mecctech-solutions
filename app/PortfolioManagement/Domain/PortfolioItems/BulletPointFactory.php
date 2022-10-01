<?php

namespace App\PortfolioManagement\Domain\PortfolioItems;

use Faker;
use Illuminate\Support\Collection;

class BulletPointFactory
{
    public static function single(): BulletPoint
    {
        $faker = Faker\Factory::create();
        return new BulletPoint($faker->name, $faker->name);
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
