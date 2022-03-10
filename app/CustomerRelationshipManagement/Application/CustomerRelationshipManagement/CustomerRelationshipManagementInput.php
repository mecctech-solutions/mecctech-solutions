<?php


namespace App\CustomerRelationshipManagement\Application\CustomerRelationshipManagement;

final class CustomerRelationshipManagementInput
{

    /**
     * @var int
     */
    protected $id;

    /**
     * CustomerRelationshipManagementInput constructor.
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
