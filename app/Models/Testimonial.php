<?php

namespace App\Models;

use Database\Factories\TestimonialFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class Testimonial extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'job_title',
        'company',
        'position',
        'text_nl',
        'text_en',
        'image_url',
        'position'
    ];

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function getImageFullUrlAttribute(): string
    {
        if (Storage::exists($this->image_url)) {
            return url('/storage/' . $this->image_url);
        }

        return url($this->image_url);
    }

    protected static function newFactory(): TestimonialFactory
    {
        return new TestimonialFactory();
    }
}
