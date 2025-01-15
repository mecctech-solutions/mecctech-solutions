<?php

namespace App\Models;

use Database\Factories\BulletPointFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BulletPoint extends Model
{
    use HasFactory;
    protected $table = 'bullet_points';
    protected $guarded = [];

    protected static function newFactory(): BulletPointFactory
    {
        return new BulletPointFactory();
    }
}
