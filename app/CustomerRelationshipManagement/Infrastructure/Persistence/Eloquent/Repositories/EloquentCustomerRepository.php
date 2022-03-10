<?php

namespace App\CustomerRelationshipManagement\Infrastructure\Persistence\Eloquent\Repositories;

use App\CustomerRelationshipManagement\Domain\Customers\Customer;
use App\CustomerRelationshipManagement\Domain\Exceptions\CustomerNotFoundException;
use App\CustomerRelationshipManagement\Infrastructure\Persistence\Eloquent\Customers\EloquentCustomer;
use App\CustomerRelationshipManagement\Infrastructure\Persistence\Eloquent\Customers\Mappers\CustomerMapper;

class EloquentCustomerRepository implements \App\CustomerRelationshipManagement\Domain\Repositories\CustomerRepositoryInterface
{

    /**
     * @inheritDoc
     */
    public function findByCustomerNumber(string $customerNumber): Customer
    {
        $model = EloquentCustomer::where('customer_number', $customerNumber)->first();
        return CustomerMapper::toEntity($model);
    }

    /**
     * @inheritDoc
     */
    public function findByEmail(string $email): Customer
    {
        $model = EloquentCustomer::where('email', $email)->first();
        return CustomerMapper::toEntity($model);    }

    public function add(Customer $customer): void
    {
        $model = CustomerMapper::toEloquent($customer);
        $model->save();
    }
}
