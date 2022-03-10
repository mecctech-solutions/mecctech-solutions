<?php


namespace App\CustomerRelationshipManagement\Application\CustomerRelationshipManagement;


interface CustomerRelationshipManagementInterface
{
    /**
     * @param CustomerRelationshipManagementInput $input
     * @return CustomerRelationshipManagementResult
     */
    public function execute(CustomerRelationshipManagementInput $input): CustomerRelationshipManagementResult;
}
