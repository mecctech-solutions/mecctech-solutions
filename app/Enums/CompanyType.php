<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum CompanyType: string implements HasLabel
{
    case Agency = 'agency';
    case DirectClient = 'direct_client';
    case StaffingAgency = 'staffing_agency';

    public function getLabel(): string
    {
        return match ($this) {
            self::Agency => 'Agency',
            self::DirectClient => 'Direct client',
            self::StaffingAgency => 'Staffing agency',
        };
    }
}
