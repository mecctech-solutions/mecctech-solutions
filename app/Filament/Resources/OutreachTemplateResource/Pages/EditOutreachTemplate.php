<?php

namespace App\Filament\Resources\OutreachTemplateResource\Pages;

use App\Filament\Resources\OutreachTemplateResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditOutreachTemplate extends EditRecord
{
    protected static string $resource = OutreachTemplateResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
