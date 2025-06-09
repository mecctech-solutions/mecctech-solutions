<?php

namespace App\Models;

use App\Builders\TagBuilder;
use Database\Factories\TagFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;

class Tag extends Model implements Sortable
{
    /** @use HasFactory<TagFactory> */
    use HasFactory;
    use SortableTrait;

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
