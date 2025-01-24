<?php

namespace App\ViewModels;

use App\Actions\GetAllPortfolioItems;
use App\Actions\GetAllVisibleTags;
use App\Data\ClientData;
use App\Data\PortfolioItemData;
use App\Data\TagData;
use App\Data\TestimonialData;
use App\Enums\SettingKey;
use App\Models\Client;
use App\Models\Setting;
use App\Models\Testimonial;
use Illuminate\Support\Collection;
use Spatie\ViewModels\ViewModel;
use Illuminate\Pagination\LengthAwarePaginator;

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

    public function portfolioItems(): LengthAwarePaginator
    {
        $items = PortfolioItemData::collect(GetAllPortfolioItems::run($this->tag));
        $itemsPerPage = (int) Setting::getValue(SettingKey::PORTFOLIO_ITEMS_PER_PAGE);
        $currentPage = request()->get('page', 1);
        
        $paginator = new LengthAwarePaginator(
            $items->forPage($currentPage, $itemsPerPage),
            $items->count(),
            $itemsPerPage,
            $currentPage,
            [
                'path' => request()->url(),
                'query' => request()->query()
            ]
        );

        return $paginator;
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
