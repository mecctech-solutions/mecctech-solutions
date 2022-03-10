<?php

namespace App\CustomerRelationshipManagement\Infrastructure\Services;

use App\CustomerRelationshipManagement\Domain\Notifications\Notification;
use App\Mail\SubmitContactRequestMail;
use Illuminate\Support\Facades\Mail;

class EmailNotificationSenderService implements \App\CustomerRelationshipManagement\Domain\Services\NotificationSenderServiceInterface
{
    private string $recipientEmailAddress;

    public function __construct(string $recipientEmailAddress)
    {
        $this->recipientEmailAddress = $recipientEmailAddress;
    }

    public function send(Notification $notification): Notification
    {
        $mailable = new SubmitContactRequestMail($notification->message(), $this->recipientEmailAddress);

        Mail::to($this->recipientEmailAddress)->send($mailable);

        return $notification;
    }
}
