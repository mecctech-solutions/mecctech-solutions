<?php

namespace App\Filament\Resources\CustomerResource\Pages;

use App\Filament\Resources\ContactRequestResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListContactRequest extends ListRecords
{
    protected static string $resource = ContactRequestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
