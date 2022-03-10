<?php

namespace App\CustomerRelationshipManagement\Infrastructure\Services;

use App\CustomerRelationshipManagement\Domain\Notifications\Notification;
use App\CustomerRelationshipManagement\Domain\Notifications\Recipient;
use App\Mail\SubmitContactRequestMail;
use Illuminate\Support\Facades\Mail;

class EmailNotificationSenderService implements \App\CustomerRelationshipManagement\Domain\Services\NotificationSenderServiceInterface
{
    public function send(Notification $notification, Recipient $recipient): Notification
    {
        $mailable = new SubmitContactRequestMail($notification->message(), $recipient->email());

        Mail::to($recipient->email())->send($mailable);

        return $notification;
    }
}
