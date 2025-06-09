<?php

use App\Http\Middleware\HandleCorsMiddleware;

test('it handles cors preflight request', function () {
    $middleware = new HandleCorsMiddleware;
    $request = Request::create('/api/test', 'OPTIONS');
    $request->headers->set('Origin', 'http://localhost:3000');
    $request->headers->set('Access-Control-Request-Method', 'POST');

    $response = $middleware->handle($request, function ($request) {
        return response('', 200);
    });

    expect($response->headers->get('Access-Control-Allow-Origin'))->toBe('*')
        ->and($response->headers->get('Access-Control-Allow-Methods'))->toContain('POST')
        ->and($response->headers->get('Access-Control-Allow-Headers'))->not->toBeNull();
});

test('it handles regular request', function () {
    $middleware = new HandleCorsMiddleware;
    $request = Request::create('/api/test', 'POST');
    $request->headers->set('Origin', 'http://localhost:3000');

    $response = $middleware->handle($request, function ($request) {
        return response('test', 200);
    });

    expect($response->headers->get('Access-Control-Allow-Origin'))->toBe('*')
        ->and($response->getContent())->toBe('test');
});
