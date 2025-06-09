<?php

use App\Data\ContactRequestData;

test('it can create from request data', function () {
    $data = [
        'name' => 'John Doe',
        'email' => 'john@example.com',
        'phone' => '1234567890',
        'message' => 'Test message',
    ];

    $contactData = ContactRequestData::fromRequest($data);

    expect($contactData)
        ->toBeInstanceOf(ContactRequestData::class)
        ->and($contactData->first_name)->toBe('John')
        ->and($contactData->last_name)->toBe('Doe')
        ->and($contactData->email)->toBe('john@example.com')
        ->and($contactData->phone_number)->toBe('1234567890')
        ->and($contactData->message)->toBe('Test message');
});

test('it handles multiple word first names', function () {
    $data = [
        'name' => 'John James Doe',
        'email' => 'john@example.com',
        'phone' => '1234567890',
        'message' => 'Test message',
    ];

    $contactData = ContactRequestData::fromRequest($data);

    expect($contactData)
        ->toBeInstanceOf(ContactRequestData::class)
        ->and($contactData->first_name)->toBe('John James')
        ->and($contactData->last_name)->toBe('Doe');
});
