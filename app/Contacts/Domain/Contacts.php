<?php


namespace App\Contacts\Domain;


class Contacts extends \Illuminate\Database\Eloquent\Model
{
    protected $table = 'contacts';

    public function getId()
    {
        return $this->id;
    }
}
