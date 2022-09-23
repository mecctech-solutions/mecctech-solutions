<?php

namespace App\CustomerRelationshipManagement\Domain\Customers;

use Faker\Factory;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class CustomerFactory
{
    public static function fromArray(array $customer): Customer
    {
        return new Customer($customer["customer_number"], $customer["first_name"], $customer["last_name"], $customer["email"], Arr::get($customer, 'phone_number'));
    }

    public static function create(int $amount = 1, array $attributes = []): Collection|Customer
    {
        $faker = Factory::create();

        $result = collect();

        for ($i = 0; $i < $amount; $i++)
        {
            $customer = new Customer(uniqid(), $faker->firstName, $faker->lastName, $faker->email, $faker->phoneNumber);

            foreach (array_keys($attributes) as $attributeName)
            {
                $attributeValue = $attributes[$attributeName];
                $methodName = "change".Str::ucfirst(Str::camel($attributeName));
                $customer->{$methodName}($attributeValue);
            }

            $result->push($customer);
        }

        if ($result->count() === 1) {
            return $result->first();
        }

        return $result;
    }
}
