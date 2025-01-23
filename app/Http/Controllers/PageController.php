<?php

namespace App\Http\Controllers;

use App\ViewModels\HomeViewModel;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PageController extends Controller
{
    public function home(Request $request)
    {
        $tag = $request->query('tag');

        if ($tag === 'All') {
            $tag = null;
        }

        return Inertia::render('Home', new HomeViewModel($tag));
    }
}
