<?php


namespace App\PortfolioManagement\Application\AddPortfolioItems;

use PASVL\Validation\ValidatorBuilder;

final class AddPortfolioItemsInput
{
    private array $portfolioItems;

    private function validate($portfolioItems)
    {
        $pattern = [
            "portfolio_items" => [
                "*" => [
                    "title" => ":string",
                    "description" => ":string",
                    "main_image" => [
                        "url" => ":string"
                    ],
                    "website_url" => ":string",
                    "images" => [
                        "*" => [
                            "url" => ":string"
                        ]
                    ],
                    "tags" => [
                        "*" => ":string"
                    ]
                ]
            ]
        ];

        $validator = ValidatorBuilder::forArray($pattern)->build();
        $validator->validate($portfolioItems);
    }

    public function __construct($input)
    {
        $this->validate($input);
        $this->portfolioItems = $input["portfolio_items"];
    }

    public function portfolioItems(): array
    {
        return $this->portfolioItems;
    }
}
