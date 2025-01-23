<?php

namespace App\Models;

use App\Actions\DetermineFullFileUrl;
use Database\Factories\TestimonialFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Testimonial extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'job_title_en',
        'job_title_nl',
        'company',
        'position',
        'text_nl',
        'text_en',
        'image_url',
        'position',
    ];

    protected $casts = [
        'text_nl' => 'string',
        'text_en' => 'string',
    ];

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function getImageFullUrlAttribute(): string
    {
        return DetermineFullFileUrl::run($this->image_url);
    }

    protected static function newFactory(): TestimonialFactory
    {
        return new TestimonialFactory;
    }
}
