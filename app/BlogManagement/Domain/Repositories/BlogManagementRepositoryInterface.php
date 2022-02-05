<?php


namespace App\BlogManagement\Domain\Repositories;


use App\BlogManagement\Domain\BlogManagement;

interface BlogManagementRepositoryInterface
{
    /**
     * @param int $id
     * @return BlogManagement|null
     */
    public function findBlogManagement(int $id): ?BlogManagement;
}
