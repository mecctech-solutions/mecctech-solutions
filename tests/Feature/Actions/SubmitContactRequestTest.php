<?php

namespace Tests\Feature\Actions;

use App\Mail\SubmitContactRequestMail;
use App\Models\ContactRequest;
use Database\Factories\ContactRequestFactory;
use Tests\TestCase;

class SubmitContactRequestTest extends TestCase
{
    /** @test */
    public function it_should_add_customer_if_it_does_not_exist(){

        // Given
        $email = 'test@test.com';
        $customer = ContactRequest::where('email', $email)->first();
        self::assertNull($customer);

        $customer = ContactRequestFactory::new()->make();
        $message = "johndoe@example.com";

        // When
        \App\Actions\SubmitContactRequest::run($customer->getAttributes(), $message);

        // Then
        self::assertNotNull(ContactRequest::where('email', $customer->email)->first());
    }

    /** @test */
    public function it_should_send_email_new_message(){

        // Given
        \Mail::fake();
        $customer = ContactRequest::factory()->create();
        $message = "Test Message";

        // When
        \App\Actions\SubmitContactRequest::run($customer->getAttributes(), $message);

        // Then
        $expectedMessage = $customer->name." with email address ".$customer->email." has sent the following message: ".$message;

        \Mail::assertSent(SubmitContactRequestMail::class, function (SubmitContactRequestMail $mail) use ($expectedMessage) {
            return $mail->message === $expectedMessage && $mail->recipientEmailAddress === 'florismeccanici@tutanota.com';
        });
    }
}
