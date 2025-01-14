<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PortfolioItemResource\Pages;
use App\Filament\Resources\PortfolioItemResource\RelationManagers;
use App\PortfolioManagement\Infrastructure\Persistence\Eloquent\PortfolioItems\EloquentPortfolioItem;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PortfolioItemResource extends Resource
{
    protected static ?string $model = EloquentPortfolioItem::class;
    protected static ?string $navigationLabel = 'Portfolio Items';
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $label = 'Portfolio Item';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('position')->label('Position'),
                Forms\Components\TextInput::make('title_nl')->label('Title (NL)'),
                Forms\Components\TextInput::make('title_en')->label('Title (EN)'),
                Forms\Components\FileUpload::make('main_image_url')
                    ->directory('/images/projects')
                    ->preserveFilenames()
                    ->label('Main Image URL'),
                Forms\Components\TextInput::make('website_url')->label('Website URL'),
                Forms\Components\Textarea::make('description_nl')->label('Description (NL)'),
                Forms\Components\Textarea::make('description_en')->label('Description (EN)'),
                Forms\Components\Select::make('tags')
                    ->relationship(name: 'tags', titleAttribute: 'name')
                    ->multiple()
                    ->label('Tags')
                    ->createOptionForm(function (Form $form) {
                        return $form
                            ->schema([
                                Forms\Components\TextInput::make('name')->label('Name'),
                            ]);
                    }),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('position'),
                Tables\Columns\TextColumn::make('title_nl'),
                Tables\Columns\TextColumn::make('title_en'),
                Tables\Columns\ImageColumn::make('main_image_url'),
                Tables\Columns\TextColumn::make('website_url'),
                Tables\Columns\TextColumn::make('description_nl'),
                Tables\Columns\TextColumn::make('description_en'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            'bulletPoints' => RelationManagers\BulletPointsRelationManager::class,
            'images' => RelationManagers\ImagesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPortfolioItems::route('/'),
            'create' => Pages\CreatePortfolioItem::route('/create'),
            'edit' => Pages\EditPortfolioItem::route('/{record}/edit'),
        ];
    }
}
