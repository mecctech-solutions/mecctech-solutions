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

    public function toArray(): array
    {
        return [
            'portfolioItems' => $this->portfolioItems(),
            'tags' => $this->tags(),
            'testimonials' => $this->testimonials(),
            'clients' => $this->clients(),
        ];
    }

    public function portfolioItems(): Collection
    {
        return PortfolioItemData::collect(GetAllPortfolioItems::run($this->tag));
    }

    public function tags(): Collection
    {
        return TagData::collect(GetAllVisibleTags::run());
    }

    public function testimonials(): Collection
    {
        return TestimonialData::collect(
            Testimonial::orderBy('position')->get()
        );
    }

    public function clients(): Collection
    {
        return ClientData::collect(
            Client::orderBy('position')->get()
        );
    }
}
