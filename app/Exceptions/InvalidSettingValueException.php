<?php

namespace App\Exceptions;

use App\Enums\SettingKey;
use Exception;

class InvalidSettingValueException extends Exception
{
    public static function invalidType(SettingKey $key, string $expectedType, mixed $value): self
    {
        $actualType = get_debug_type($value);

        return new self("Invalid value type for setting '{$key->value}'. Expected {$expectedType}, got {$actualType}.");
    }

    public static function invalidRange(SettingKey $key, mixed $value, int $min, int $max): self
    {
        return new self("Invalid value for setting '{$key->value}'. Value must be between {$min} and {$max}, got {$value}.");
    }
}
