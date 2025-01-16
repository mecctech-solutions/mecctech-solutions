<?php

namespace App\Http\Controllers;

use App\Actions\GetAllPortfolioItems;
use App\Actions\GetAllVisibleTags;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PageController extends Controller
{
    public function home(Request $request)
    {
        $tag = $request->query('tag');
        ray($tag);
        if ($tag == 'All')
        {
            $tag = null;
        }

        return Inertia::render('Home')->with([
            'portfolioItems' => GetAllPortfolioItems::run($tag),
            'tags' => GetAllVisibleTags::run(),
        ]);
    }
}
