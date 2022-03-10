<?php

namespace Tests\Feature\CustomerRelationshipManagement;

use App\CustomerRelationshipManagement\Domain\Customers\Customer;
use App\CustomerRelationshipManagement\Domain\Exceptions\CustomerNotFoundException;

class DummyCustomerRepository implements \App\CustomerRelationshipManagement\Domain\Repositories\CustomerRepositoryInterface
{
    private \Illuminate\Support\Collection $customers;

    public function __construct()
    {
        $this->customers = collect();
    }

    public function findByCustomerNumber(string $customerNumber): Customer
    {
        $customer = $this->customers->first(function (Customer $customer) use ($customerNumber) {
            return $customer->customerNumber() === $customerNumber;
        });

        if ($customer === null)
        {
            throw new CustomerNotFoundException("Customer with customer number ".$customerNumber." not found");
        }

        return $customer;
    }

    public function add(Customer $customer): void
    {
        $this->customers->push($customer);
    }
}
