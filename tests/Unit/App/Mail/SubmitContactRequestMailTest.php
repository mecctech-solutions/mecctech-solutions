<?php


use App\Mail\SubmitContactRequestMail;
use Tests\TestCase;

class SubmitContactRequestMailTest extends TestCase
{
    /** @test */
    public function it_should_have_a_view_with_a_message(){

        // Given
        $message = "Test Message";
        $recipientEmailAddress = "johndoe@example.com";

        // When
        $mailable = new SubmitContactRequestMail($message, $recipientEmailAddress);

        // Then
        $mailable->assertSeeInHtml($message);
    }
}
