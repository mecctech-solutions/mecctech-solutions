<?php

namespace App\Filament\Resources\PortfolioItemResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class BulletPointsRelationManager extends RelationManager
{
    protected static string $relationship = 'bulletPoints';

    protected static ?string $label = 'Bullet Points';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('text_nl')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('text_en')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('text_nl')
            ->columns([
                Tables\Columns\TextColumn::make('text_nl'),
                Tables\Columns\TextColumn::make('text_en'),
            ])
            ->reorderable('position')
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
