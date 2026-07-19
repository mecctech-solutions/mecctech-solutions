<?php

use App\Actions\NormalizeDomain;

it('normalises websites to a canonical domain', function (string $input, string $expected) {
    expect(NormalizeDomain::run($input))->toBe($expected);
})->with([
    'scheme, www and path' => ['https://www.Example.NL/vacatures', 'example.nl'],
    'bare domain' => ['example.nl', 'example.nl'],
    'uppercase bare domain' => ['Example.NL', 'example.nl'],
    'http scheme' => ['http://example.nl', 'example.nl'],
    'www without scheme' => ['www.example.nl', 'example.nl'],
    'query string' => ['https://example.nl/contact?ref=1', 'example.nl'],
    'surrounding whitespace' => ['  https://example.nl  ', 'example.nl'],
    'empty string' => ['', ''],
]);
