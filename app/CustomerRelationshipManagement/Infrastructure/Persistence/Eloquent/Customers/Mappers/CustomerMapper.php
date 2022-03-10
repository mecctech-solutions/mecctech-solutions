<?php

namespace App\CustomerRelationshipManagement\Infrastructure\Persistence\Eloquent\Customers\Mappers;

use App\CustomerRelationshipManagement\Domain\Customers\Customer;
use App\CustomerRelationshipManagement\Infrastructure\Persistence\Eloquent\Customers\EloquentCustomer;

class CustomerMapper
{
    public static function toEntity(EloquentCustomer $model): Customer
    {
        return new Customer($model->customer_number, $model->first_name, $model->last_name, $model->email);
    }

    public static function toEloquent(Customer $customer): EloquentCustomer
    {
        return new EloquentCustomer([
            'customer_number' => $customer->customerNumber(),
            'first_name' => $customer->firstName(),
            'last_name' => $customer->lastName(),
            'email' => $customer->email()
        ]);
    }
}
