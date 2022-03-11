<?php

namespace App\CustomerRelationshipManagement\Infrastructure\Services;

use App\CustomerRelationshipManagement\Domain\Notifications\Notification;
use App\CustomerRelationshipManagement\Domain\Notifications\Recipient;
use App\Jobs\SendMailJob;
use App\Mail\SubmitContactRequestMail;
use Illuminate\Support\Facades\Mail;

class EmailNotificationSenderService implements \App\CustomerRelationshipManagement\Domain\Services\NotificationSenderServiceInterface
{
    public function send(Notification $notification, Recipient $recipient): Notification
    {
        $mailable = new SubmitContactRequestMail($notification->message(), $recipient->email());

        SendMailJob::dispatch(
            $mailable, $recipient->email()
        )->onQueue('emails');

        return $notification;
    }
}
