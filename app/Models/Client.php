<?php

namespace App\Models;

use Database\Factories\ClientFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'website_url',
        'logo_url',
        'position'
    ];

    public function testimonials(): HasMany
    {
        return $this->hasMany(Testimonial::class);
    }

    public function getLogoFullUrlAttribute(): string
    {
        if (Storage::exists($this->logo_url)) {
            return url('/storage/' . $this->logo_url);
        }

        return url($this->logo_url);
    }

    protected static function newFactory(): ClientFactory
    {
        return new ClientFactory();
    }
}
