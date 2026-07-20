<?php

namespace App\Filament\Resources;

use App\Actions\CreateOutreachAttempt;
use App\Actions\MarkOutreachAttemptSent;
use App\Actions\QualifyProspect;
use App\Actions\RenderOutreachTemplate;
use App\Builders\ProspectBuilder;
use App\Enums\CompanyType;
use App\Enums\QualificationStatus;
use App\Filament\Resources\ProspectResource\Pages;
use App\Filament\Resources\ProspectResource\RelationManagers;
use App\Models\OutreachAttempt;
use App\Models\OutreachTemplate;
use App\Models\Prospect;
use Closure;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Js;
use Livewire\Component;

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
                static::composeAction(),
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

    /**
     * The compose row action on the prospect table: a fresh first outreach.
     */
    protected static function composeAction(): Tables\Actions\Action
    {
        return static::buildComposeAction(
            Tables\Actions\Action::make('compose'),
            prospectFrom: function (Model $record): Prospect {
                assert($record instanceof Prospect);

                return $record;
            },
            followUpFrom: fn (Model $record): ?OutreachAttempt => null,
        )->label('Compose');
    }

    /**
     * Configure a compose modal that renders a template, lets the operator edit
     * the copy and then records a sent attempt in one click.
     *
     * The app never sends the mail: the operator copies the composed message
     * and sends it from Outlook by hand. "Copy & mark as sent" copies the body
     * and records an attempt so the tracking never depends on memory; "Copy" is
     * the escape hatch for only looking and records nothing.
     *
     * Shared between the prospect table (a first attempt) and the outreach
     * history relation manager (a follow-up), which differ only in how the
     * prospect and the attempt being followed up are resolved from the row
     * record. `$prospectFrom` and `$followUpFrom` both receive that record.
     *
     * @param  Closure(Model): Prospect  $prospectFrom
     * @param  Closure(Model): ?OutreachAttempt  $followUpFrom
     */
    public static function buildComposeAction(
        Tables\Actions\Action $action,
        Closure $prospectFrom,
        Closure $followUpFrom,
    ): Tables\Actions\Action {
        return $action
            ->icon('heroicon-o-envelope')
            ->modalHeading('Compose outreach')
            ->modalWidth('3xl')
            ->fillForm(fn (Model $record): array => [
                'contact_email' => $prospectFrom($record)->contact_email,
            ])
            ->form([
                Forms\Components\TextInput::make('contact_email')
                    ->label('To')
                    ->helperText('Outlook needs a recipient — copy this into the To field.')
                    ->disabled()
                    ->dehydrated(false)
                    ->suffixAction(
                        Forms\Components\Actions\Action::make('copyEmail')
                            ->icon('heroicon-m-clipboard')
                            ->label('Copy email')
                            ->visible(fn (?string $state): bool => filled($state))
                            ->action(function (?string $state, Component $livewire): void {
                                $livewire->js('window.navigator.clipboard.writeText('.Js::from($state).')');
                            }),
                    ),
                Forms\Components\Select::make('outreach_template_id')
                    ->label('Template')
                    ->options(fn (Model $record): array => OutreachTemplate::query()
                        ->where(function (Builder $query) use ($prospectFrom, $record): void {
                            $query->where('company_type', $prospectFrom($record)->type)
                                ->orWhereNull('company_type');
                        })
                        ->orderBy('name')
                        ->pluck('name', 'id')
                        ->all())
                    ->helperText("Templates matching this prospect's type, plus generic ones.")
                    ->required()
                    ->live()
                    ->afterStateUpdated(function (?string $state, Forms\Set $set, Model $record) use ($prospectFrom): void {
                        $template = OutreachTemplate::find($state);

                        if ($template === null) {
                            return;
                        }

                        $rendered = RenderOutreachTemplate::run($template, $prospectFrom($record));
                        $set('subject', $rendered['subject']);
                        $set('body', $rendered['body']);
                    }),
                Forms\Components\TextInput::make('subject')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('body')
                    ->required()
                    ->rows(14)
                    ->helperText('Edit as needed — the sent text is snapshotted, not the template.'),
            ])
            ->modalSubmitActionLabel('Copy & mark as sent')
            ->extraModalFooterActions(fn (Tables\Actions\Action $action): array => [
                $action->makeModalSubmitAction('copyOnly', arguments: ['markSent' => false])
                    ->label('Copy')
                    ->color('gray'),
            ])
            ->action(function (Model $record, array $data, array $arguments, Component $livewire) use ($prospectFrom, $followUpFrom): void {
                $livewire->js('window.navigator.clipboard.writeText('.Js::from($data['body']).')');

                if (! ($arguments['markSent'] ?? true)) {
                    Notification::make()
                        ->title('Copied to clipboard')
                        ->body('No attempt was recorded.')
                        ->success()
                        ->send();

                    return;
                }

                $template = OutreachTemplate::findOrFail($data['outreach_template_id']);

                $attempt = CreateOutreachAttempt::run(
                    prospect: $prospectFrom($record),
                    template: $template,
                    followUpTo: $followUpFrom($record),
                    subject: $data['subject'],
                    body: $data['body'],
                );

                MarkOutreachAttemptSent::run($attempt);

                Notification::make()
                    ->title('Copied and marked as sent')
                    ->success()
                    ->send();
            });
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\OutreachAttemptsRelationManager::class,
        ];
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
