<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum OutreachOutcome: string implements HasColor, HasLabel
{
    case PositiveReply = 'positive_reply';
    case Meeting = 'meeting';
    case Client = 'client';
    case Negative = 'negative';

    public function getLabel(): string
    {
        return match ($this) {
            self::PositiveReply => 'Positive reply',
            self::Meeting => 'Meeting',
            self::Client => 'Client',
            self::Negative => 'Negative',
        };
    }

    public function getColor(): string
    {
        return match ($this) {
            self::PositiveReply => 'info',
            self::Meeting => 'warning',
            self::Client => 'success',
            self::Negative => 'danger',
        };
    }
}
