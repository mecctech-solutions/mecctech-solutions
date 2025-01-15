<?php

namespace App\Models;

use Database\Factories\ImageFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $table = "images";
    protected $guarded = [];

    public function fullUrl(): Attribute
    {
        return new Attribute(
            get: function () {
                if (\Storage::exists($this->url)) {
                    return \Storage::url($this->url);
                }

                return url($this->url);
            });
    }

    protected static function newFactory(): ImageFactory
    {
        return new ImageFactory();
    }
}
