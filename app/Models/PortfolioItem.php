<?php

namespace App\Models;

use App\Actions\DetermineFullFileUrl;
use App\Builders\PortfolioItemBuilder;
use Database\Factories\PortfolioItemFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;

/**
 * @property string $main_image_url
 * @property CaseStudy|null $caseStudy
 * @property-read string $mainImageFullUrl
 * @property-read bool $hasCaseStudy
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Tag> $tags
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Image> $images
 * @property-read \Illuminate\Database\Eloquent\Collection<int, BulletPoint> $bulletPoints
 */
class PortfolioItem extends Model implements Sortable
{
    use HasFactory;
    use SortableTrait;

    protected $table = 'portfolio_items';

    protected $fillable = [
        'title_nl', 'title_en', 'main_image_url', 'description_nl', 'description_en', 'website_url', 'position',
    ];

    protected $casts = [
        'visible' => 'boolean',
        'website_url' => 'string',
    ];

    /**
     * @return Attribute<string, never>
     */
    public function mainImageFullUrl(): Attribute
    {
        return new Attribute(
            get: function () {
                return DetermineFullFileUrl::run($this->main_image_url);
            });
    }

    /**
     * @return BelongsToMany<Tag>
     */
    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'portfolio_item_tag', 'portfolio_item_id', 'tag_id');
    }

    /**
     * @return HasMany<Image>
     */
    public function images(): HasMany
    {
        return $this->hasMany(Image::class, 'portfolio_item_id');
    }

    /**
     * @return HasMany<BulletPoint>
     */
    public function bulletPoints(): HasMany
    {
        return $this->hasMany(BulletPoint::class, 'portfolio_item_id');
    }

    /**
     * @return HasOne<CaseStudy>
     */
    public function caseStudy(): HasOne
    {
        return $this->hasOne(CaseStudy::class);
    }

    public function hasCaseStudy(): bool
    {
        return $this->caseStudy()->exists();
    }

    /**
     * @param \Illuminate\Database\Query\Builder $query
     */
    public function newEloquentBuilder($query): PortfolioItemBuilder
    {
        return new PortfolioItemBuilder($query);
    }

    /**
     * @return PortfolioItemFactory
     */
    protected static function newFactory(): PortfolioItemFactory
    {
        return new PortfolioItemFactory;
    }
}
