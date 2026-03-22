<?php

namespace App\Actions;

use App\Data\BlogPostData;
use App\Models\BlogPost;
use Illuminate\Pagination\LengthAwarePaginator;
use Lorisleiva\Actions\Concerns\AsAction;

class GetPublishedBlogPosts
{
    use AsAction;

    public const PER_PAGE = 9;

    /**
     * @return LengthAwarePaginator<int, array<mixed>>
     */
    public function handle(?int $perPage = null): LengthAwarePaginator
    {
        $perPage ??= self::PER_PAGE;

        $queryPaginator = BlogPost::query()
            ->published()
            ->orderByDesc('published_at')
            ->paginate($perPage);

        $items = $queryPaginator->getCollection()->map(
            fn (BlogPost $blogPost) => BlogPostData::fromModel($blogPost)->toArray()
        );

        return (new LengthAwarePaginator(
            $items,
            $queryPaginator->total(),
            $queryPaginator->perPage(),
            $queryPaginator->currentPage(),
            [
                'path' => $queryPaginator->path(),
                'pageName' => $queryPaginator->getPageName(),
            ],
        ))->withQueryString();
    }
}
