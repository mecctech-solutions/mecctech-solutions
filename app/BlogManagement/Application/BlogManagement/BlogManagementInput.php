<?php


namespace App\BlogManagement\Application\BlogManagement;

final class BlogManagementInput
{

    /**
     * @var int
     */
    protected $id;

    /**
     * BlogManagementInput constructor.
     * @param int $id
     * @throws \Exception
     */
    public function __construct(int $id)
    {
        // DO VALIDATIONS...
        if($id < 0) {
            throw new \Exception('Lower then 0');
        }

        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getId(): int
    {
        return $this->id;
    }

}
