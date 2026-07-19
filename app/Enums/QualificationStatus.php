<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum QualificationStatus: string implements HasColor, HasLabel
{
    case Pending = 'pending';
    case Suitable = 'suitable';
    case Unsuitable = 'unsuitable';

    public function getLabel(): string
    {
        return match ($this) {
            self::Pending => 'Pending',
            self::Suitable => 'Suitable',
            self::Unsuitable => 'Unsuitable',
        };
    }

    public function getColor(): string
    {
        return match ($this) {
            self::Pending => 'gray',
            self::Suitable => 'success',
            self::Unsuitable => 'danger',
        };
    }
}
