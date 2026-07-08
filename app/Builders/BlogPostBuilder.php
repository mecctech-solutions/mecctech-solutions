<?php

namespace App\Builders;

use App\Models\BlogPost;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;

/**
 * @extends Builder<BlogPost>
 */
class BlogPostBuilder extends Builder
{
    public function published(): self
    {
        return $this
            ->whereNotNull('published_at')
            ->where('published_at', '<=', Carbon::now());
    }

    public function draft(): self
    {
        return $this->where(function (Builder $query): void {
            $query
                ->whereNull('published_at')
                ->orWhere('published_at', '>', Carbon::now());
        });
    }

    public function search(string $term): self
    {
        return $this->where(function (Builder $query) use ($term): void {
            $query
                ->where('title_nl', 'like', "%{$term}%")
                ->orWhere('title_en', 'like', "%{$term}%");
        });
    }
}
