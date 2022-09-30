<?php

namespace App\CustomerRelationshipManagement\Infrastructure\Persistence\Eloquent\Customers;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string $customer_number
 * @property string $email
 * @property string $first_name
 * @property string $last_name
 * @property string $phone_number
 */
class EloquentCustomer extends Model
{
    protected $table = 'customers';
    protected $guarded = [];
}
