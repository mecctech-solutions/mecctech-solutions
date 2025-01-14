<?php

namespace App\PortfolioManagement\Infrastructure\Persistence\Eloquent\PortfolioItems;

use Illuminate\Database\Eloquent\Casts\Attribute;

class EloquentImage extends \Illuminate\Database\Eloquent\Model
{
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
}
