<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BlockHackedUrls
{
    public function handle(Request $request, Closure $next): Response
    {
        if (preg_match('/^\d$/', $request->path())) {
            abort(410);
        }

        return $next($request);
    }
}
