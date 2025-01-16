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
        $tags = Tag::query()->where('visible', true)->orderBy('position')->get();
        return TagData::collect($tags);
    }
}
