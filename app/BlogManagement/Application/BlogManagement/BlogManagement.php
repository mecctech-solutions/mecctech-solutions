<?php


namespace App\BlogManagement\Application\BlogManagement;

class BlogManagement implements BlogManagementInterface
{
    /**
     * BlogManagement constructor.
     */
    public function __construct()
    {

    }

    /**
     * @inheritDoc
     */
    public function execute(BlogManagementInput $input): BlogManagementResult
    {
        $result = new BlogManagementResult();
        $result->id = 1;

        return $result;
    }
}
