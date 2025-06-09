<?php

namespace App\Http\Controllers;

use App\ViewModels\HomeViewModel;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class PageController extends Controller
{
    public function home(Request $request): Response
    {
        $tag = $request->query('tag');

        if ($tag === 'All' || ! is_string($tag)) {
            $tag = null;
        }

        return Inertia::render('Home', new HomeViewModel($tag));
    }
}
