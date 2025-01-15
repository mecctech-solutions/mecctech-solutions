<?php

namespace App\Filament\Resources\PortfolioItemResource\Pages;

use App\Actions\ImportPortfolioItems;
use App\Filament\Resources\PortfolioItemResource;
use Filament\Actions;
use Filament\Forms\Components\FileUpload;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Facades\Storage;

class ListPortfolioItems extends ListRecords
{
    protected static string $resource = PortfolioItemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            Actions\Action::make('import_from_excel')
                ->label('Import from Excel')
                ->action(function (array $data) {
                    $fileName = $data['file'];
                    $fileFullPath = Storage::disk('public')->path($fileName);
                    ImportPortfolioItems::run($fileFullPath);
                })
                ->form([
                    FileUpload::make('file')
                        ->label('Upload Excel File')
                        ->required()
                ])
            ,
        ];
    }
}
