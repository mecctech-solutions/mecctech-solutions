<?php

it('should return status redirect', function () {
    // Given
    $url = route('submit-contact-request');

    // When
    $response = $this
        // Otherwise CORS error will be thrown (419)
        ->withoutMiddleware()
        ->post($url, [
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'johndoe@example.com',
            'message' => 'Test Message',
            'phone' => '0612345678',
        ]);

    // Then
    self::assertEquals(302, $response->status());
});

it('should store contact request', function () {
    // Given
    $url = route('submit-contact-request');
    $contactRequestData = [
        'first_name' => 'John',
        'last_name' => 'Doe',
        'email' => 'john@example.com',
        'message' => 'Test Message',
        'phone' => '0612345678',
    ];

    // When
    $this->post($url, $contactRequestData);

    // Then
    $this->assertDatabaseHas('contact_requests', $contactRequestData);
});
