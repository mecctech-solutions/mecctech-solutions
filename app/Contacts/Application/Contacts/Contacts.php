<?php


namespace App\Contacts\Application\Contacts;

class Contacts implements ContactsInterface
{
    /**
     * Contacts constructor.
     */
    public function __construct()
    {

    }

    /**
     * @inheritDoc
     */
    public function execute(ContactsInput $input): ContactsResult
    {
        $result = new ContactsResult();
        $result->id = 1;

        return $result;
    }
}
