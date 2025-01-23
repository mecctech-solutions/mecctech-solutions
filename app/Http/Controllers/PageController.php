<?php

namespace App\Http\Controllers;

use App\Actions\GetAllPortfolioItems;
use App\Actions\GetAllVisibleTags;
use App\Data\ClientData;
use App\Data\PortfolioItemData;
use App\Data\TagData;
use App\Data\TestimonialData;
use App\Models\Client;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PageController extends Controller
{
    public function home(Request $request)
    {
        $tag = $request->query('tag');

        if ($tag == 'All') {
            $tag = null;
        }

        $portfolioItems = GetAllPortfolioItems::run($tag);

        $portfolioItems->load('caseStudy:id,portfolio_item_id,slug');

        return Inertia::render('Home', [
            'portfolioItems' => PortfolioItemData::collection($portfolioItems)
                ->map(fn ($item) => [
                    ...$item->toArray(),
                    'has_case_study' => $item->hasCaseStudy(),
                    'case_study' => $item->caseStudy ? [
                        'slug' => $item->caseStudy->slug
                    ] : null,
                ]),
            'tags' => TagData::collection(GetAllVisibleTags::run()),
            'testimonials' => TestimonialData::collection(
                Testimonial::orderBy('position')->get()
            ),
            'clients' => ClientData::collect(
                Client::orderBy('position')
                    ->get()
            ),
        ]);
    }
}
