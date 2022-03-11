<?php

namespace App\CustomerRelationshipManagement\Infrastructure\Persistence\Eloquent\Repositories;

use App\CustomerRelationshipManagement\Domain\Customers\Customer;
use App\CustomerRelationshipManagement\Domain\Exceptions\CustomerNotFoundException;
use App\CustomerRelationshipManagement\Infrastructure\Persistence\Eloquent\Customers\EloquentCustomer;
use App\CustomerRelationshipManagement\Infrastructure\Persistence\Eloquent\Customers\Mappers\CustomerMapper;
use App\PortfolioManagement\Infrastructure\Exceptions\EloquentCustomerOperationException;

class EloquentCustomerRepository implements \App\CustomerRelationshipManagement\Domain\Repositories\CustomerRepositoryInterface
{

    /**
     * @inheritDoc
     */
    public function findByCustomerNumber(string $customerNumber): Customer
    {
        $model = EloquentCustomer::where('customer_number', $customerNumber)->first();

        if ($model === null)
        {
            throw new CustomerNotFoundException("Customer with customer number ".$customerNumber." not found");
        }

        return CustomerMapper::toEntity($model);
    }

    /**
     * @inheritDoc
     */
    public function findByEmail(string $email): Customer
    {
        $model = EloquentCustomer::where('email', $email)->first();

        if ($model === null)
        {
            throw new CustomerNotFoundException("Customer with email ".$email." not found");
        }

        return CustomerMapper::toEntity($model);
    }

    public function add(Customer $customer): void
    {
        if ($customer->customerNumber() === null)
        {
            throw new EloquentCustomerOperationException("Customer number cannot be null");
        }

        $model = CustomerMapper::toEloquent($customer);
        $model->save();
    }
}
