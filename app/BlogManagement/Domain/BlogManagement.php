<?php


namespace App\BlogManagement\Domain;


class BlogManagement extends \Illuminate\Database\Eloquent\Model
{
    protected $table = 'blogmanagements';

    public function getId()
    {
        return $this->id;
    }
}
