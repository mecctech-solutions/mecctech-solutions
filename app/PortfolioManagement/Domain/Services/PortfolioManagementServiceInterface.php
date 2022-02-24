<?php

namespace App\PortfolioManagement\Domain\Services;

use Illuminate\Support\Collection;

interface PortfolioManagementServiceInterface
{
    public function addPortfolioItems(Collection $portfolioItems): void;
}
