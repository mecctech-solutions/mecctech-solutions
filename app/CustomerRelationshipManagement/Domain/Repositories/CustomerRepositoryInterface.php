<?php


namespace App\CustomerRelationshipManagement\Domain\Repositories;


use App\CustomerRelationshipManagement\Domain\Customers\Customer;

interface CustomerRepositoryInterface
{
    public function findByCustomerNumber(string $customerNumber): Customer;

    public function add(Customer $customer): void;
}
