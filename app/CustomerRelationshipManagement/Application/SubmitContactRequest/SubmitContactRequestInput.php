<?php


namespace App\CustomerRelationshipManagement\Application\SubmitContactRequest;

use PASVL\Validation\ValidatorBuilder;

final class SubmitContactRequestInput
{
    private array $customer;
    private string $message;

    private function validate($portfolioItems)
    {
        $pattern = [
            "customer" => [
                "customer_number" => ":string?",
                "first_name" => ":string",
                "last_name" => ":string",
                "email" => ":string"
            ],
            "message" => ":string"
        ];

        $validator = ValidatorBuilder::forArray($pattern)->build();
        $validator->validate($portfolioItems);
    }

    public function __construct($input)
    {
        $this->validate($input);
        $this->customer = $input["customer"];
        $this->message = $input["message"];
    }

    public function customer(): array
    {
        return $this->customer;
    }

    public function message(): string
    {
        return $this->message;
    }
}
