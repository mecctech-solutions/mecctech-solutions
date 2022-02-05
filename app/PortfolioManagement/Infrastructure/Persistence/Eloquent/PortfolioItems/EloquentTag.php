<?php

namespace App\PortfolioManagement\Infrastructure\Persistence\Eloquent\PortfolioItems;

/**
 * @property string $name
 */
class EloquentTag extends \Illuminate\Database\Eloquent\Model
{
    protected $table = "tags";
    protected $guarded = [];
}
