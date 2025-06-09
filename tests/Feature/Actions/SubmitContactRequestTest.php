<?php

use App\Actions\SubmitContactRequest;
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
    SubmitContactRequest::run($data);

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
    SubmitContactRequest::run($data);

    // Then
    $expectedMessage = $customer->full_name.' with email address '.$customer->email.' has sent the following message: '.$message;

    \Mail::assertSent(SubmitContactRequestMail::class, function (SubmitContactRequestMail $mail) use ($expectedMessage) {
        return $mail->message === $expectedMessage && $mail->recipientEmailAddress === 'florismeccanici@tutanota.com';
    });
});

it('should create new contact request with same email', function () {
    // Given
    $contactRequest = ContactRequest::factory()->create(['message' => 'Old message']);
    $newMessage = 'New message';

    $data = new ContactRequestData(
        first_name: $contactRequest->first_name,
        last_name: $contactRequest->last_name,
        email: $contactRequest->email,
        phone_number: $contactRequest->phone_number,
        message: $newMessage
    );

    // When
    SubmitContactRequest::run($data);

    // Then
    $contactRequestsForEmail = ContactRequest::where('email', $contactRequest->email)->get();
    expect($contactRequestsForEmail)->toHaveCount(2);

    $newContactRequest = ContactRequest::where('email', $contactRequest->email)->latest('id')->first();
    expect($newContactRequest->message)->toBe($newMessage);
});
