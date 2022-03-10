<?php

namespace App\CustomerRelationshipManagement\Domain\Services;


use App\CustomerRelationshipManagement\Domain\Notifications\Notification;
use App\CustomerRelationshipManagement\Domain\Notifications\Recipient;

interface NotificationSenderServiceInterface
{
    public function send(Notification $notification, Recipient $recipient): Notification;
}
