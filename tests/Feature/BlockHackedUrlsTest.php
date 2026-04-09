<?php

it('returns 410 for single digit hacked urls', function (string $path) {
    $this->get($path)->assertGone();
})->with([
    '/0', '/1', '/2', '/3', '/4', '/5', '/6', '/7', '/8', '/9',
]);

it('does not block non-hacked urls', function () {
    $this->get('/')->assertOk();
});
