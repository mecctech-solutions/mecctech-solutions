<?php

namespace App\Filament\Resources;

use App\Actions\RenderOutreachTemplate;
use App\Enums\CompanyType;
use App\Filament\Resources\OutreachTemplateResource\Pages;
use App\Models\OutreachTemplate;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class OutreachTemplateResource extends Resource
{
    protected static ?string $model = OutreachTemplate::class;

    protected static ?string $navigationIcon = 'heroicon-o-envelope';

    protected static ?string $navigationGroup = 'Outreach';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('company_type')
                    ->label('Company type')
                    ->options(CompanyType::class)
                    ->helperText('Leave empty for a generic template that applies to any prospect.'),
                Forms\Components\TextInput::make('subject')
                    ->required()
                    ->maxLength(255)
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('body')
                    ->required()
                    ->rows(15)
                    ->columnSpanFull()
                    ->helperText(
                        'Available placeholders: '
                        .collect(RenderOutreachTemplate::recognisedPlaceholderNames())
                            ->map(fn (string $name): string => '{{'.$name.'}}')
                            ->join(', ')
                        .'. Whitespace inside the braces is tolerated; unknown placeholders are left untouched. '
                        .'Remember to include a clear opt-out sentence — every commercial message must offer one '
                        .'(art. 11.7 Telecommunicatiewet).'
                    ),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('company_type')
                    ->label('Company type')
                    ->badge()
                    ->placeholder('Generic'),
                Tables\Columns\TextColumn::make('subject')
                    ->searchable()
                    ->limit(50),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('company_type')
                    ->label('Company type')
                    ->options(CompanyType::class),
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

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOutreachTemplates::route('/'),
            'create' => Pages\CreateOutreachTemplate::route('/create'),
            'edit' => Pages\EditOutreachTemplate::route('/{record}/edit'),
        ];
    }
}
