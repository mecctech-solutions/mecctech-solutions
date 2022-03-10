<?php


namespace App\CustomerRelationshipManagement\Application\SubmitContactRequest;


interface SubmitContactRequestInterface
{
    /**
     * @param SubmitContactRequestInput $input
     * @return SubmitContactRequestResult
     */
    public function execute(SubmitContactRequestInput $input): SubmitContactRequestResult;
}
