<?php

namespace App\CustomerRelationshipManagement\Domain\Notifications;

class Notification
{
    private string $message;

    /**
     * @param string $message
     */
    public function __construct(string $message)
    {
        $this->message = $message;
    }

    public function message(): string
    {
        return $this->message;
    }
}
