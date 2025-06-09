<?php

use App\Jobs\SendMailJob;

it('should return status redirect', function () {
    // Given
    $url = route('submit-contact-request');

    // When
    $response = $this->post($url, [
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'johndoe@example.com',
            'message' => 'Test Message',
            'phone' => '0612345678',
        ]);

    // Then
    expect($response->status())->toEqual(302);
});

it('should store contact request', function () {
    // Given
    $url = route('submit-contact-request');

    // When
    $this->post($url, [
        'name' => 'John Doe',
        'email' => 'john@example.com',
        'message' => 'Test Message',
        'phone' => '0612345678',
    ]);

    // Then
    $this->assertDatabaseHas('contact_requests', [
        'first_name' => 'John',
        'last_name' => 'Doe',
        'email' => 'john@example.com',
        'message' => 'Test Message',
        'phone_number' => '0612345678',
    ]);
});

it('should dispatch email on queue', function() {
    // Arrange
    $url = route('submit-contact-request');
    Queue::fake();

    // Act & Assert
    $this->post($url, [
        'name' => 'John Doe',
        'email' => 'john@example.com',
        'message' => 'Test Message',
        'phone' => '0612345678',
    ]);

    Queue::assertPushed(SendMailJob::class);
});
