<?php

namespace App\Builders;

use Illuminate\Database\Eloquent\Builder;

class PortfolioItemBuilder extends Builder
{
    public function sorted()
    {
        return $this
            ->with([
                'images' => function ($query) {
                    $query->orderBy('position');
                },
                'bulletPoints' => function ($query) {
                    $query->orderBy('position');
                },
            ])
            ->orderBy('position');
    }
}
