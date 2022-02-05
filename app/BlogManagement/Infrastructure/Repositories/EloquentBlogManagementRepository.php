<?php


namespace App\BlogManagement\Infrastructure\Repositories;


use App\BlogManagement\Domain\Repositories\BlogManagementRepositoryInterface;
use App\BlogManagement\Domain\BlogManagement;

class EloquentBlogManagementRepository implements BlogManagementRepositoryInterface
{

    /**
     * @inheritDoc
     */
    public function findBlogManagement(int $id): ?BlogManagement
    {
        return BlogManagement::find($id);
    }
}
