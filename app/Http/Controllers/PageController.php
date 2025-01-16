<?php

namespace App\Http\Controllers;

use App\Actions\GetAllPortfolioItems;
use Inertia\Inertia;

class PageController extends Controller
{
    public function home()
    {
        return Inertia::render('Home')->with([
            'portfolioItems' => GetAllPortfolioItems::run(),
        ]);
    }
}
