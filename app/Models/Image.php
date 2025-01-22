<?php

namespace App\Models;

use App\Actions\DetermineFullFileUrl;
use Database\Factories\ImageFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;

class Image extends Model implements Sortable
{
    use HasFactory;
    use SortableTrait;

    protected $table = 'images';

    protected $guarded = [];

    public function fullUrl(): Attribute
    {
        return new Attribute(
            get: function () {
                return DetermineFullFileUrl::run($this->url);
            });
    }

    public function buildSortQuery(): Builder
    {
        return static::query()->where('portfolio_item_id', $this->portfolio_item_id);
    }

    protected static function newFactory(): ImageFactory
    {
        return new ImageFactory;
    }
}
