<?php

namespace App\CustomerRelationshipManagement\Domain\Services;


use App\CustomerRelationshipManagement\Domain\Notifications\Notification;

interface NotificationSenderServiceInterface
{
    public function send(Notification $notification): Notification;
}
