<?php

namespace App\Mail;

use App\CustomerRelationshipManagement\Domain\Customers\Customer;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SubmitContactRequestMail extends Mailable
{
    use Queueable, SerializesModels;

    private string $message;
    private string $recipientEmailAddress;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(string $message,
                                string $recipientEmailAddress)
    {
        $this->message = $message;
        $this->recipientEmailAddress = $recipientEmailAddress;
    }

    public function message(): string
    {
        return $this->message;
    }

    public function recipientEmailAddress(): string
    {
        return $this->recipientEmailAddress;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->from($this->recipientEmailAddress)
            ->view('views.mails.submit-contact-request');
    }
}
