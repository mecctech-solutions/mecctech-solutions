<?php

namespace App\Actions;

use App\Data\BlogPostData;
use App\Models\BlogPost;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Carbon;
use Lorisleiva\Actions\Concerns\AsAction;

class GetAllBlogPosts
{
    use AsAction;

    public const PER_PAGE = 15;

    /**
     * @param  'all'|'draft'|'published'  $status
     * @return LengthAwarePaginator<int, array<mixed>>
     */
    public function handle(?string $search = null, string $status = 'all', ?int $perPage = null, int $page = 1): LengthAwarePaginator
    {
        $perPage ??= self::PER_PAGE;

        $paginator = BlogPost::query()
            ->when($status === 'published', fn (Builder $query) => $query->published())
            ->when($status === 'draft', fn (Builder $query) => $this->scopeDraft($query))
            ->when(is_string($search) && $search !== '', fn (Builder $query) => $this->scopeSearch($query, (string) $search))
            ->latest()
            ->paginate(perPage: $perPage, page: $page);

        $items = $paginator->getCollection()->map(
            fn (BlogPost $blogPost) => BlogPostData::fromModel($blogPost)->toArray()
        );

        return new LengthAwarePaginator(
            $items,
            $paginator->total(),
            $paginator->perPage(),
            $paginator->currentPage(),
        );
    }

    /**
     * @param  Builder<BlogPost>  $query
     * @return Builder<BlogPost>
     */
    private function scopeDraft(Builder $query): Builder
    {
        return $query->where(fn (Builder $query) => $query
            ->whereNull('published_at')
            ->orWhere('published_at', '>', Carbon::now()));
    }

    /**
     * @param  Builder<BlogPost>  $query
     * @return Builder<BlogPost>
     */
    private function scopeSearch(Builder $query, string $search): Builder
    {
        return $query->where(fn (Builder $query) => $query
            ->where('title_nl', 'like', "%{$search}%")
            ->orWhere('title_en', 'like', "%{$search}%"));
    }
}
