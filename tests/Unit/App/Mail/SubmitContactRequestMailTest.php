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

test('it builds mail with correct content', function () {
    $message = 'Test message';
    $recipientEmail = 'test@example.com';

    $mail = new SubmitContactRequestMail($message, $recipientEmail);

    expect($mail->message)->toBe($message)
        ->and($mail->recipientEmailAddress)->toBe($recipientEmail);
});

test('it renders mail content', function () {
    $message = 'Test message';
    $recipientEmail = 'test@example.com';

    $mail = new SubmitContactRequestMail($message, $recipientEmail);
    $rendered = $mail->render();

    expect($rendered)->toContain($message);
});
