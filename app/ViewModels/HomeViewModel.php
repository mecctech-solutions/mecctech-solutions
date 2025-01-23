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

    protected function portfolioItems(): Collection
    {
        $portfolioItems = GetAllPortfolioItems::run($this->tag);
        $portfolioItems->load('caseStudy:id,portfolio_item_id,slug');

        return PortfolioItemData::collect($portfolioItems)
            ->through(fn ($item) => PortfolioItemData::fromModel($item));
    }

    protected function tags(): Collection
    {
        return TagData::collect(GetAllVisibleTags::run());
    }

    protected function testimonials(): Collection
    {
        return TestimonialData::collect(
            Testimonial::orderBy('position')->get()
        );
    }

    protected function clients(): Collection
    {
        return ClientData::collect(
            Client::orderBy('position')->get()
        );
    }
}
