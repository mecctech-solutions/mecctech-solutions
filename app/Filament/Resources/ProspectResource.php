<?php

namespace App\Filament\Resources;

use App\Actions\QualifyProspect;
use App\Builders\ProspectBuilder;
use App\Enums\CompanyType;
use App\Enums\QualificationStatus;
use App\Filament\Resources\ProspectResource\Pages;
use App\Models\Prospect;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ProspectResource extends Resource
{
    protected static ?string $model = Prospect::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-office-2';

    protected static ?string $navigationGroup = 'Outreach';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('type')
                    ->options(CompanyType::class)
                    ->required(),
                Forms\Components\TextInput::make('website')
                    ->url()
                    ->maxLength(255)
                    ->columnSpanFull()
                    ->helperText(
                        'Paste the URL straight from the address bar — a deep link such as a /vacatures page '
                        .'is fine and is kept as entered. The domain below is derived from it.'
                    )
                    ->suffixAction(
                        Forms\Components\Actions\Action::make('openWebsite')
                            ->icon('heroicon-m-arrow-top-right-on-square')
                            ->url(fn (?string $state): ?string => $state, shouldOpenInNewTab: true)
                            ->visible(fn (?string $state): bool => filled($state)),
                    ),
                Forms\Components\TextInput::make('domain')
                    ->disabled()
                    ->dehydrated(false)
                    ->helperText('Derived automatically from the website and used to de-duplicate imports. It cannot be edited directly.'),
                Forms\Components\TextInput::make('contact_first_name')
                    ->label('Contact first name')
                    ->maxLength(255),
                Forms\Components\TextInput::make('contact_last_name')
                    ->label('Contact last name')
                    ->maxLength(255),
                Forms\Components\TextInput::make('contact_email')
                    ->label('Contact email')
                    ->email()
                    ->maxLength(255),
                Forms\Components\Textarea::make('notes')
                    ->rows(4)
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(query: fn (ProspectBuilder $query, string $search): ProspectBuilder => $query->search($search))
                    ->sortable(),
                Tables\Columns\TextColumn::make('website')
                    ->url(fn (Prospect $record): ?string => $record->website, shouldOpenInNewTab: true)
                    ->color('primary')
                    ->limit(40)
                    ->placeholder('—')
                    ->toggleable(),
                Tables\Columns\TextColumn::make('type')
                    ->badge(),
                Tables\Columns\TextColumn::make('qualification_status')
                    ->label('Qualification')
                    ->badge(),
                Tables\Columns\TextColumn::make('contact_name')
                    ->label('Contact')
                    ->getStateUsing(fn (Prospect $record): string => trim("{$record->contact_first_name} {$record->contact_last_name}"))
                    ->placeholder('—'),
                Tables\Columns\TextColumn::make('contact_email')
                    ->label('Contact email')
                    ->placeholder('—')
                    ->toggleable(),
                Tables\Columns\TextColumn::make('latestOutreachAttempt.sent_at')
                    ->label('Last attempt')
                    ->dateTime()
                    ->placeholder('—')
                    ->sortable(),
                Tables\Columns\TextColumn::make('latestOutreachAttempt.outcome')
                    ->label('Outcome')
                    ->badge()
                    ->placeholder('—'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('qualification_status')
                    ->label('Qualification')
                    ->options(QualificationStatus::class)
                    ->default(QualificationStatus::Pending->value),
                Tables\Filters\SelectFilter::make('type')
                    ->options(CompanyType::class),
            ])
            ->actions([
                Tables\Actions\Action::make('qualify')
                    ->icon('heroicon-o-check-badge')
                    ->fillForm(fn (Prospect $record): array => [
                        'qualification_status' => $record->qualification_status->value,
                        'qualification_reason' => $record->qualification_reason,
                    ])
                    ->form([
                        Forms\Components\Radio::make('qualification_status')
                            ->label('Qualification')
                            ->options(QualificationStatus::class)
                            ->required(),
                        Forms\Components\TextInput::make('qualification_reason')
                            ->label('Reason')
                            ->datalist(fn (): array => Prospect::query()
                                ->whereNotNull('qualification_reason')
                                ->distinct()
                                ->pluck('qualification_reason')
                                ->all())
                            ->helperText('Why suitable or unsuitable? Free text — pick a previous reason or type a new one.'),
                    ])
                    ->modalHeading('Qualify prospect')
                    ->modalSubmitActionLabel('Save')
                    ->action(function (Prospect $record, array $data): void {
                        QualifyProspect::run(
                            $record,
                            QualificationStatus::from($data['qualification_status']),
                            filled($data['qualification_reason']) ? $data['qualification_reason'] : null,
                        );
                    }),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProspects::route('/'),
            'create' => Pages\CreateProspect::route('/create'),
            'edit' => Pages\EditProspect::route('/{record}/edit'),
        ];
    }
}
