<?php

namespace App\CustomerRelationshipManagement\Domain\Customers;

class CustomerFactory
{
    public static function fromArray(array $customer): Customer
    {
        return new Customer($customer["customer_number"], $customer["first_name"], $customer["last_name"], $customer["email"]);
    }
}
