<?php

namespace App\Models;

use App\Enums\SettingKey;
use Database\Factories\SettingFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    /**
     * @use HasFactory<SettingFactory>
     */
    use HasFactory;

    protected $fillable = ['key', 'value'];

    public static function getValue(SettingKey $key): mixed
    {
        $setting = static::where('key', $key->value)->first();

        if (! $setting) {
            return $key->defaultValue();
        }

        return $setting->value;
    }

    public static function setValue(SettingKey $key, mixed $value): void
    {
        // Validate the value before saving
        $key->validate($value);

        static::updateOrCreate(
            ['key' => $key->value],
            ['value' => $value]
        );
    }
}
