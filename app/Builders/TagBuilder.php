<?php

namespace App\Builders;

use Illuminate\Database\Eloquent\Builder;

class TagBuilder extends Builder
{
    public function visible(): TagBuilder
    {
        return $this->where('visible', true);
    }

    public function sorted(): TagBuilder
    {
        return $this->orderBy('position');
    }
}
