<?php

namespace App\Models;

use Database\Factories\BulletPointFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;

class BulletPoint extends Model implements Sortable
{
    use HasFactory;
    use SortableTrait;

    protected $table = 'bullet_points';

    protected $guarded = [];

    public function buildSortQuery(): Builder
    {
        return static::query()->where('portfolio_item_id', $this->portfolio_item_id);
    }

    protected static function newFactory(): BulletPointFactory
    {
        return new BulletPointFactory;
    }
}
