<?php

namespace App\Models;

use App\Builders\BlogPostBuilder;
use Carbon\CarbonInterface;
use Database\Factories\BlogPostFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

/**
 * @property CarbonInterface|null $published_at
 */
class BlogPost extends Model
{
    /** @use HasFactory<BlogPostFactory> */
    use HasFactory;

    protected $fillable = [
        'title_nl',
        'title_en',
        'slug',
        'excerpt_nl',
        'excerpt_en',
        'content_nl',
        'content_en',
        'featured_image',
        'published_at',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'published_at' => 'datetime',
        ];
    }

    public function isPublished(): bool
    {
        return $this->published_at !== null && $this->published_at->lte(now());
    }

    /**
     * @param  Builder  $query
     */
    public function newEloquentBuilder($query): BlogPostBuilder
    {
        return new BlogPostBuilder($query);
    }

    protected static function newFactory(): BlogPostFactory
    {
        return BlogPostFactory::new();
    }
}
