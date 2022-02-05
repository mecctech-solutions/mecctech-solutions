<?php

namespace App\PortfolioManagement\Domain\PortfolioItems;

use App\SharedKernel\CleanArchitecture\ValueObject;

class Image extends ValueObject
{
    private string $url;

    public function __construct(string $url)
    {
        $this->url = $url;
    }

    public function url(): string
    {
        return $this->url;
    }

}
