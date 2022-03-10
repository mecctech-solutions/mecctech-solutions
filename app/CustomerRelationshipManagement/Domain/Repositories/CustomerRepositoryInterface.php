<?php


namespace App\CustomerRelationshipManagement\Domain\Repositories;


use App\CustomerRelationshipManagement\Domain\Customers\Customer;
use App\CustomerRelationshipManagement\Domain\Exceptions\CustomerNotFoundException;

interface CustomerRepositoryInterface
{
    /** @throws CustomerNotFoundException */
    public function findByCustomerNumber(string $customerNumber): Customer;

    /** @throws CustomerNotFoundException */
    public function findByEmail(string $email): Customer;
    public function add(Customer $customer): void;
}
