<?php

namespace App\Actions;

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
        return GetAllBlogPosts::run(status: 'published', perPage: $perPage ?? self::PER_PAGE);
    }
}
