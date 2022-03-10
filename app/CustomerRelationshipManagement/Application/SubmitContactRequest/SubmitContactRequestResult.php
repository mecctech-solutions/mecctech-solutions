<?php


namespace App\CustomerRelationshipManagement\Application\SubmitContactRequest;


use App\CustomerRelationshipManagement\Domain\Notifications\Notification;

final class SubmitContactRequestResult
{
    private Notification $notificationSent;

    /**
     * @param Notification $notificationSent
     */
    public function __construct(Notification $notificationSent)
    {
        $this->notificationSent = $notificationSent;
    }

    public function notificationSent(): Notification
    {
        return $this->notificationSent;
    }
}
