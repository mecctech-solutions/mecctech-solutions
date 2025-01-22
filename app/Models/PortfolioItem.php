<?php

namespace App\Models;

use App\Actions\DetermineFullFileUrl;
use Database\Factories\PortfolioItemFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;

class PortfolioItem extends Model implements Sortable
{
    use HasFactory;
    use SortableTrait;

    protected $table = 'portfolio_items';

    protected $fillable = [
        'title_nl', 'title_en', 'main_image_url', 'description_nl', 'description_en', 'website_url', 'position',
    ];

    public $sortable = [
        'order_column_name' => 'position',
        'sort_when_creating' => true,
    ];

    public function mainImageFullUrl(): Attribute
    {
        return new Attribute(
            get: function () {
                return DetermineFullFileUrl::run($this->main_image_url);
            });
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'portfolio_item_tag', 'portfolio_item_id', 'tag_id');
    }

    public function images()
    {
        return $this->hasMany(Image::class, 'portfolio_item_id');
    }

    public function bulletPoints()
    {
        return $this->hasMany(BulletPoint::class, 'portfolio_item_id');
    }

    protected static function newFactory(): PortfolioItemFactory
    {
        return new PortfolioItemFactory;
    }
}
