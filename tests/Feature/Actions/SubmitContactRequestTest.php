<?php

use App\Data\ContactRequestData;
use App\Mail\SubmitContactRequestMail;
use App\Models\ContactRequest;
use Database\Factories\ContactRequestFactory;

it('should add customer if it does not exist', function () {
    // Given
    $email = 'test@test.com';
    $customer = ContactRequest::where('email', $email)->first();
    self::assertNull($customer);

    $customer = ContactRequestFactory::new()->make();
    $data = new ContactRequestData(
        first_name: $customer->first_name,
        last_name: $customer->last_name,
        email: $customer->email,
        phone_number: $customer->phone_number,
        message: 'johndoe@example.com'
    );

    // When
    \App\Actions\SubmitContactRequest::run($data);

    // Then
    self::assertNotNull(ContactRequest::where('email', $customer->email)->first());
});

it('should send email with new message', function () {
    // Given
    \Mail::fake();
    $message = 'Test Message';
    $customer = ContactRequest::factory()->create(['message' => $message]);

    $data = new ContactRequestData(
        first_name: $customer->first_name,
        last_name: $customer->last_name,
        email: $customer->email,
        phone_number: $customer->phone_number,
        message: $message
    );

    // When
    \App\Actions\SubmitContactRequest::run($data);

    // Then
    $expectedMessage = $customer->full_name.' with email address '.$customer->email.' has sent the following message: '.$message;

    \Mail::assertSent(SubmitContactRequestMail::class, function (SubmitContactRequestMail $mail) use ($expectedMessage) {
        return $mail->message === $expectedMessage && $mail->recipientEmailAddress === 'florismeccanici@tutanota.com';
    });
});
