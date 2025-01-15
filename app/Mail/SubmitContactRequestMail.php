<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SubmitContactRequestMail extends Mailable
{
    use Queueable, SerializesModels;

    public string $message;
    public string $recipientEmailAddress;

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
            ->view('emails.submit-contact-request')
            ->with([
                'messages' => $this->message
            ]);
    }
}
