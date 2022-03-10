<?php


namespace App\CustomerRelationshipManagement\Application\CustomerRelationshipManagement;

class CustomerRelationshipManagement implements CustomerRelationshipManagementInterface
{
    /**
     * CustomerRelationshipManagement constructor.
     */
    public function __construct()
    {

    }

    /**
     * @inheritDoc
     */
    public function execute(CustomerRelationshipManagementInput $input): CustomerRelationshipManagementResult
    {
        $result = new CustomerRelationshipManagementResult();
        $result->id = 1;

        return $result;
    }
}
