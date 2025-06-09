<?php

namespace App\Actions;

use App\Models\Tag;
use Illuminate\Support\Collection;
use Lorisleiva\Actions\Concerns\AsAction;

class GetAllVisibleTags
{
    use AsAction;

    /**
     * @return Collection<int, Tag>
     */
    public function handle(): Collection
    {
        return Tag::query()->visible()->sorted()->get();
    }
}
