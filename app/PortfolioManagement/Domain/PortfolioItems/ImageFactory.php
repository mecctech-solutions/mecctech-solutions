<?php

namespace App\PortfolioManagement\Domain\PortfolioItems;

use Illuminate\Support\Collection;
use JetBrains\PhpStorm\Pure;

class ImageFactory
{
    #[Pure] public static function placeholder(): Image
    {
        return new Image("images/placeholder.png");
    }

    public static function placeholders(int $amount): Collection
    {
        $result = collect();

        for ($i = 0; $i < $amount; $i++)
        {
            $result->push(self::placeholder());
        }

        return $result;
    }
}
