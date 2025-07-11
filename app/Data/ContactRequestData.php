<?php

namespace App\Data;

use Spatie\LaravelData\Data;

class ContactRequestData extends Data
{
    public function __construct(
        public string $first_name,
        public string $last_name,
        public string $email,
        public string $phone_number,
        public string $message,
        public ?string $company = null,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromRequest(array $data): self
    {
        $name = $data['name'];
        $parts = explode(' ', $name);
        $lastName = array_pop($parts);
        $firstName = implode(' ', $parts);

        return new self(
            first_name: $firstName,
            last_name: $lastName,
            email: $data['email'],
            phone_number: $data['phone'],
            company: \Arr::get($data, 'company'),
            message: $data['message'],
        );
    }
}
