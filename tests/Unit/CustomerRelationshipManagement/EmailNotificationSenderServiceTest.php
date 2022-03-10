<?php

namespace Tests\Unit\CustomerRelationshipManagement;

use App\CustomerRelationshipManagement\Domain\Customers\Customer;
use App\CustomerRelationshipManagement\Domain\Notifications\Notification;
use App\CustomerRelationshipManagement\Domain\Notifications\Recipient;
use App\CustomerRelationshipManagement\Infrastructure\Services\EmailNotificationSenderService;
use App\Mail\SubmitContactRequestMail;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class EmailNotificationSenderServiceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp(); // TODO: Change the autogenerated stub
    }

    /** @test */
    public function it_should_send_a_message_to_the_correct_email_address(){

        // Given
        Mail::fake();

        $recipient = new Recipient("florismeccanici@mecctech-solutions.nl");

        $emailNotificationSenderService = new EmailNotificationSenderService();
        $notification = new Notification("Test Message");

        // When
        $emailNotificationSenderService->send($notification, $recipient);

        // Then
        Mail::assertSent(SubmitContactRequestMail::class, function (Mailable $mail) use ($notification, $recipient){
            return $mail->hasTo($recipient->email());
        });

        Mail::assertSent(SubmitContactRequestMail::class, function (Mailable $mail) use ($notification) {
            return $mail->message() === $notification->message();
        });
    }
}
