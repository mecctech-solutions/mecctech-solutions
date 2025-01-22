<?php

namespace Tests\Feature\Controllers;

use Tests\TestCase;

class SubmitContactRequestTest extends TestCase
{
    /** @test */
    public function it_should_return_status_redirect()
    {

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
    }
}
