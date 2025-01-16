<?php

namespace App\Actions;

use App\Data\TagData;
use App\Models\Tag;
use Illuminate\Support\Collection;
use Lorisleiva\Actions\Concerns\AsAction;

class GetAllVisibleTags
{
    use AsAction;

    public function handle(): Collection
    {
        return TagData::collect(Tag::query()->where('visible', true)->get());
    }
}
