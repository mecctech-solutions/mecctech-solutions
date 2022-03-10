<?php

namespace Tests\Feature\CustomerRelationshipManagement;

use App\CustomerRelationshipManagement\Domain\Notifications\Notification;

class DummyNotificationSenderService implements \App\CustomerRelationshipManagement\Domain\Services\NotificationSenderServiceInterface
{

    public function send(Notification $notification): Notification
    {
        return $notification;
    }
}
