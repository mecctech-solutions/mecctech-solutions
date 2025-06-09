<?php

use App\Http\Requests\SubmitContactRequestRequest;

test('validation rules are correct', function () {
    $request = new SubmitContactRequestRequest;

    $rules = $request->rules();

    expect($rules)->toHaveKeys(['name', 'email', 'phone', 'message'])
        ->and($rules['name'])->toContain('required', 'string', 'min:2')
        ->and($rules['email'])->toContain('required', 'email')
        ->and($rules['phone'])->toContain('required', 'string')
        ->and($rules['message'])->toContain('required', 'string', 'min:10');
});

test('request is authorized', function () {
    $request = new SubmitContactRequestRequest;

    expect($request->authorize())->toBeTrue();
});
