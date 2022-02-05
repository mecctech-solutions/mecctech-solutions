<?php


namespace App\PortfolioManagement\Application\GetPortfolioItemsWithTag;

use PASVL\Validation\ValidatorBuilder;

final class GetPortfolioItemsWithTagInput
{
    private mixed $tag;

    private function validate($order)
    {
        $pattern = [
            "tag" => ":string"
        ];

        $validator = ValidatorBuilder::forArray($pattern)->build();
        $validator->validate($order);
    }

    public function __construct($input)
    {
        $this->validate($input);
        $this->tag = $input["tag"];
    }

    public function tag(): string
    {
        return $this->tag;
    }
}
