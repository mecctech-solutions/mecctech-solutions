<?php


namespace App\Contacts\Application\Contacts;


interface ContactsInterface
{
    /**
     * @param ContactsInput $input
     * @return ContactsResult
     */
    public function execute(ContactsInput $input): ContactsResult;
}
