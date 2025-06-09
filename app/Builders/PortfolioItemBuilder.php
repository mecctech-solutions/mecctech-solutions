<?php

namespace App\Builders;

use App\Models\PortfolioItem;
use Illuminate\Database\Eloquent\Builder;

/**
 * @extends Builder<PortfolioItem>
 */
class PortfolioItemBuilder extends Builder
{
    public function sorted(): self
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
