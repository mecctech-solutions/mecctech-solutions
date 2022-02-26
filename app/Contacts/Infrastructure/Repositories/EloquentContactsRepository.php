<?php


namespace App\Contacts\Infrastructure\Repositories;


use App\Contacts\Domain\Repositories\ContactsRepositoryInterface;
use App\Contacts\Domain\Contacts;

class EloquentContactsRepository implements ContactsRepositoryInterface
{

    /**
     * @inheritDoc
     */
    public function findContacts(int $id): ?Contacts
    {
        return Contacts::find($id);
    }
}
