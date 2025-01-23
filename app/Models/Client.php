<?php

namespace App\Models;

use App\Actions\DetermineFullFileUrl;
use Database\Factories\ClientFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'website_url',
        'logo_url',
        'position',
    ];

    public function testimonials(): HasMany
    {
        return $this->hasMany(Testimonial::class);
    }

    public function getLogoFullUrlAttribute(): string
    {
        return DetermineFullFileUrl::run($this->logo_url);
    }

    protected static function newFactory(): ClientFactory
    {
        return new ClientFactory;
    }
}
