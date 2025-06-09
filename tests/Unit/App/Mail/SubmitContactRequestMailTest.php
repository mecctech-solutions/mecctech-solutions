<?php

use App\Mail\SubmitContactRequestMail;

it('should have a view with a message', function () {
    // Given
    $message = 'Test Message';
    $recipientEmailAddress = 'johndoe@example.com';

    // When
    $mailable = new SubmitContactRequestMail($message, $recipientEmailAddress);

    // Then
    $mailable->assertSeeInHtml($message);
});
