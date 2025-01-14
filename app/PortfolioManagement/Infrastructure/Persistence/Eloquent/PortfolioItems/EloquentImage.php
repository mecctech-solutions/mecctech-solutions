<?php

namespace App\PortfolioManagement\Infrastructure\Persistence\Eloquent\PortfolioItems;

use Illuminate\Database\Eloquent\Casts\Attribute;

class EloquentImage extends \Illuminate\Database\Eloquent\Model
{
    protected $table = "images";
    protected $guarded = [];

    public function url(): Attribute
    {
        return new Attribute(
            get: function ($value) {
                if (\Storage::exists($value)) {
                    return \Storage::url($value);
                }

                return $value;
            },
            set: function ($value) {
                return $value;
            });
    }
}
