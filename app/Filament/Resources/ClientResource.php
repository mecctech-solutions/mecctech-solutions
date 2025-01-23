<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ClientResource\Pages;
use App\Models\Client;
use Filament\Forms;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ClientResource extends Resource
{
    protected static ?string $model = Client::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-office';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Tabs::make('Client')
                    ->tabs([
                        Tab::make('Client Details')
                            ->schema([
                                Forms\Components\TextInput::make('name')
                                    ->required()
                                    ->maxLength(255),
                                Forms\Components\TextInput::make('website_url')
                                    ->required()
                                    ->url()
                                    ->maxLength(255),
                                Forms\Components\FileUpload::make('logo_url')
                                    ->required()
                                    ->image()
                                    ->directory('clients'),
                                Forms\Components\TextInput::make('position')
                                    ->required()
                                    ->numeric()
                                    ->default(1),
                            ]),
                        Tab::make('Testimonials')
                            ->schema([
                                Forms\Components\Repeater::make('testimonials')
                                    ->relationship()
                                    ->schema([
                                        Forms\Components\TextInput::make('name')
                                            ->required()
                                            ->maxLength(255),
                                        Forms\Components\TextInput::make('job_title')
                                            ->required()
                                            ->maxLength(255),
                                        Forms\Components\TextInput::make('job_title')
                                            ->required()
                                            ->maxLength(255),
                                        Forms\Components\Textarea::make('text_nl')
                                            ->required()
                                            ->maxLength(1000),
                                        Forms\Components\Textarea::make('text_en')
                                            ->required()
                                            ->maxLength(1000),
                                        Forms\Components\FileUpload::make('image_url')
                                            ->image()
                                            ->directory('testimonials'),
                                        Forms\Components\TextInput::make('position')
                                            ->numeric()
                                            ->default(1),
                                    ])
                                    ->defaultItems(0)
                                    ->reorderableWithButtons()
                                    ->collapsible()
                                    ->collapseAllAction(
                                        fn (Forms\Components\Actions\Action $action) => $action->label('Collapse all')
                                    )
                                    ->expandAllAction(
                                        fn (Forms\Components\Actions\Action $action) => $action->label('Expand all')
                                    )
                            ])
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('website_url')
                    ->searchable(),
                Tables\Columns\ImageColumn::make('logo_url'),
                Tables\Columns\TextColumn::make('position')
                    ->sortable(),
            ])
            ->defaultSort('position')
            ->reorderable('position')
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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListClients::route('/'),
            'create' => Pages\CreateClient::route('/create'),
            'edit' => Pages\EditClient::route('/{record}/edit'),
        ];
    }
}
