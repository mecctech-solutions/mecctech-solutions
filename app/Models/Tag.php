<?php

namespace App\Models;

use App\Builders\TagBuilder;
use Database\Factories\TagFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $table = 'tags';

    protected $guarded = [];

    protected $casts = [
        'visible' => 'boolean',
    ];

    protected static function newFactory(): TagFactory
    {
        return new TagFactory;
    }

    public function newEloquentBuilder($query): TagBuilder
    {
        return new TagBuilder($query);
    }
}
