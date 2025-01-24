<?php

namespace App\Models;

use Database\Factories\CaseStudyFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CaseStudy extends Model
{
    use HasFactory;

    protected $fillable = [
        'portfolio_item_id',
        'title_nl',
        'title_en',
        'content_nl',
        'content_en',
        'slug',
    ];

    public function portfolioItem(): BelongsTo
    {
        return $this->belongsTo(PortfolioItem::class);
    }

    protected static function newFactory(): CaseStudyFactory
    {
        return new CaseStudyFactory;
    }
}
