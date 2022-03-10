<?php

namespace Tests\Feature\CustomerRelationshipManagement;

use App\CustomerRelationshipManagement\Domain\Notifications\Notification;
use App\CustomerRelationshipManagement\Domain\Notifications\Recipient;

class DummyNotificationSenderService implements \App\CustomerRelationshipManagement\Domain\Services\NotificationSenderServiceInterface
{

    public function send(Notification $notification, Recipient $recipient): Notification
    {
        return $notification;
    }
}
