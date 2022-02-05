<?php


namespace App\BlogManagement\Application\BlogManagement;


interface BlogManagementInterface
{
    /**
     * @param BlogManagementInput $input
     * @return BlogManagementResult
     */
    public function execute(BlogManagementInput $input): BlogManagementResult;
}
