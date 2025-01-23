<?php

namespace App\Http\Controllers;

use App\Actions\GetAllPortfolioItems;
use App\Actions\GetAllVisibleTags;
use App\Data\ClientData;
use App\Data\PortfolioItemData;
use App\Data\TagData;
use App\Models\Client;
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

        return Inertia::render('Home', [
            'portfolioItems' => PortfolioItemData::collect(GetAllPortfolioItems::run($tag)),
            'tags' => TagData::collect(GetAllVisibleTags::run()),
            'clients' => ClientData::collection(
                Client::with('testimonials')
                    ->whereHas('testimonials')
                    ->orderBy('position')
                    ->get()
            ),
        ]);
    }
}
