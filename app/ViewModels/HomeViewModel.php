<?php

namespace App\ViewModels;

use App\Actions\GetAllPortfolioItems;
use App\Actions\GetAllVisibleTags;
use App\Data\ClientData;
use App\Data\PortfolioItemData;
use App\Data\TagData;
use App\Data\TestimonialData;
use App\Models\Client;
use App\Models\Testimonial;
use Illuminate\Support\Collection;
use Spatie\ViewModels\ViewModel;

class HomeViewModel extends ViewModel
{
    public function __construct(
        private readonly ?string $tag = null
    ) {}

    public function portfolioItems(): Collection
    {
        $portfolioItems = GetAllPortfolioItems::run($this->tag);
        $portfolioItems->load('caseStudy:id,portfolio_item_id,slug');

        return PortfolioItemData::collection($portfolioItems)
            ->through(fn ($item) => PortfolioItemData::fromModel($item));
    }

    public function tags(): Collection
    {
        return TagData::collection(GetAllVisibleTags::run());
    }

    public function testimonials(): Collection
    {
        return TestimonialData::collection(
            Testimonial::orderBy('position')->get()
        );
    }

    public function clients(): Collection
    {
        return ClientData::collection(
            Client::orderBy('position')->get()
        );
    }
} 