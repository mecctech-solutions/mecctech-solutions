<?php

namespace App\Http\Controllers;

use App\Actions\GetAllPortfolioItems;
use App\Actions\GetAllVisibleTags;
use App\Data\PortfolioItemData;
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

        return Inertia::render('Home')->with([
            'portfolioItems' => PortfolioItemData::collect(GetAllPortfolioItems::run($tag)),
            'tags' => GetAllVisibleTags::run(),
        ]);
    }
}
