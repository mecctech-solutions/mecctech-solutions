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
    ) {}

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
            message: $data['message'],
        );
    }
}
