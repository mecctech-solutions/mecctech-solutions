<?php

namespace App\CustomerRelationshipManagement\Domain\Customers;

use Faker\Factory;
use Illuminate\Support\Collection;

class CustomerFactory
{
    public static function fromArray(array $customer): Customer
    {
        return new Customer($customer["customer_number"], $customer["first_name"], $customer["last_name"], $customer["email"]);
    }

    public static function create(int $amount = 1, array $attributes = []): Collection
    {
        $faker = Factory::create();

        $result = collect();

        for ($i = 0; $i < $amount; $i++)
        {
            $customer = new Customer(uniqid(), $faker->firstName, $faker->lastName, $faker->email);
            $result->push($customer);
        }

        return $result;
    }
}
