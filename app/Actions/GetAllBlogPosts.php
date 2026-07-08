<?php

namespace App\Actions;

use App\Builders\BlogPostBuilder;
use App\Data\BlogPostData;
use App\Models\BlogPost;
use Illuminate\Pagination\LengthAwarePaginator;
use Lorisleiva\Actions\Concerns\AsAction;

class GetAllBlogPosts
{
    use AsAction;

    public const PER_PAGE = 15;

    /**
     * @param  'all'|'draft'|'published'  $status
     * @return LengthAwarePaginator<int, array<mixed>>
     */
    public function handle(?string $search = null, string $status = 'all', ?int $perPage = null, ?int $page = null): LengthAwarePaginator
    {
        $perPage ??= self::PER_PAGE;

        /** @var LengthAwarePaginator<int, array<mixed>> $paginator */
        $paginator = BlogPost::query()
            ->when($status === 'published', fn (BlogPostBuilder $query) => $query->published())
            ->when($status === 'draft', fn (BlogPostBuilder $query) => $query->draft())
            ->when(is_string($search) && $search !== '', fn (BlogPostBuilder $query) => $query->search((string) $search))
            ->when(
                $status === 'published',
                fn (BlogPostBuilder $query) => $query->orderByDesc('published_at'),
                fn (BlogPostBuilder $query) => $query->latest(),
            )
            ->paginate(perPage: $perPage, page: $page)
            ->withQueryString()
            ->through(fn (BlogPost $blogPost) => BlogPostData::fromModel($blogPost)->toArray());

        return $paginator;
    }
}
