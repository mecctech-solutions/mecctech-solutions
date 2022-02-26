<?php


namespace App\Contacts\Domain\Repositories;


use App\Contacts\Domain\Contacts;

interface ContactsRepositoryInterface
{
    /**
     * @param int $id
     * @return Contacts|null
     */
    public function findContacts(int $id): ?Contacts;
}
