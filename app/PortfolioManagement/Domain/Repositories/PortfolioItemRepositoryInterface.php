<?php

namespace App\PortfolioManagement\Domain\Repositories;

use App\PortfolioManagement\Domain\PortfolioItems\Description;
use App\PortfolioManagement\Domain\PortfolioItems\Image;
use App\PortfolioManagement\Domain\PortfolioItems\PortfolioItem;
use App\PortfolioManagement\Domain\PortfolioItems\Title;
use Illuminate\Support\Collection;

interface PortfolioItemRepositoryInterface
{
    public function all(): Collection;
    public function add(PortfolioItem $portfolioItem): void;
    public function addMultiple(Collection $portfolioItems): void;
    public function find(Title $title, Image $mainImage, Description $description, string $websiteUrl): ?PortfolioItem;
}
