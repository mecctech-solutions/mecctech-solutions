<?php

namespace App\Builders;

use App\Models\Tag;
use Illuminate\Database\Eloquent\Builder;

/**
 * @extends Builder<Tag>
 */
class TagBuilder extends Builder
{
    public function visible(): self
    {
        return $this->where('visible', true);
    }

    public function sorted(): self
    {
        return $this->orderBy('position');
    }
}
