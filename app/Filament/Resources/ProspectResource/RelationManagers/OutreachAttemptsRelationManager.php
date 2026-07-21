<?php

namespace App\Filament\Resources\ProspectResource\RelationManagers;

use App\Actions\RecordOutreachOutcome;
use App\Builders\OutreachAttemptBuilder;
use App\Enums\OutreachOutcome;
use App\Filament\Resources\ProspectResource;
use App\Models\OutreachAttempt;
use App\Models\Prospect;
use Filament\Forms;
use Filament\Infolists;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\HtmlString;

/**
 * The outreach history for a single prospect: every attempt, newest first,
 * with follow-ups shown as a chain. This is where outcome tracking and the
 * "who needs chasing" follow-up view live.
 */
class OutreachAttemptsRelationManager extends RelationManager
{
    protected static string $relationship = 'outreachAttempts';

    protected static ?string $title = 'Outreach history';

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('subject')
            ->columns([
                Tables\Columns\TextColumn::make('sent_at')
                    ->label('Sent')
                    ->dateTime()
                    ->placeholder('Draft')
                    ->sortable(),
                Tables\Columns\TextColumn::make('subject')
                    ->label('Subject')
                    ->limit(40)
                    ->tooltip(fn (OutreachAttempt $record): string => $record->subject),
                Tables\Columns\TextColumn::make('outreachTemplate.name')
                    ->label('Template')
                    ->placeholder('—')
                    ->toggleable(),
                Tables\Columns\IconColumn::make('follow_up_to_id')
                    ->label('Follow-up')
                    ->boolean()
                    ->trueIcon('heroicon-o-arrow-uturn-right')
                    ->falseIcon('heroicon-o-minus')
                    ->tooltip(function (OutreachAttempt $record): ?string {
                        $original = $record->followUpTo;

                        if ($original === null) {
                            return null;
                        }

                        return 'Follows up on the attempt sent '.$original->sent_at?->toFormattedDateString();
                    }),
                Tables\Columns\TextColumn::make('outcome')
                    ->badge()
                    ->placeholder('Awaiting reply'),
                Tables\Columns\TextColumn::make('outcome_note')
                    ->label('Note')
                    ->limit(40)
                    ->placeholder('—')
                    ->toggleable(),
            ])
            ->defaultSort('sent_at', 'desc')
            ->filters([
                Tables\Filters\Filter::make('due_for_follow_up')
                    ->label('Due for follow-up')
                    ->query(fn (OutreachAttemptBuilder $query): OutreachAttemptBuilder => $query->dueForFollowUp()),
            ])
            ->actions([
                static::viewMessageAction(),
                static::recordOutcomeAction(),
                static::followUpAction(),
            ])
            ->emptyStateHeading('No outreach yet')
            ->emptyStateDescription('Compose a first attempt from the prospect list.');
    }

    protected static function viewMessageAction(): Tables\Actions\Action
    {
        return Tables\Actions\ViewAction::make('viewMessage')
            ->label('View message')
            ->icon('heroicon-o-envelope-open')
            ->modalHeading('Message sent')
            ->infolist([
                Infolists\Components\TextEntry::make('subject')
                    ->label('Subject'),
                Infolists\Components\TextEntry::make('body')
                    ->label('Message')
                    ->html()
                    ->formatStateUsing(fn (string $state): HtmlString => new HtmlString(nl2br(e($state))))
                    ->columnSpanFull(),
            ]);
    }

    /**
     * Record what came of a sent attempt. `outcome_note` is deliberately free
     * text, not an enum: the operator has never tracked this, so the categories
     * are unknown. Promote later if the same note keeps getting typed.
     */
    protected static function recordOutcomeAction(): Tables\Actions\Action
    {
        return Tables\Actions\Action::make('recordOutcome')
            ->label('Record outcome')
            ->icon('heroicon-o-flag')
            ->visible(fn (OutreachAttempt $record): bool => $record->isSent())
            ->fillForm(fn (OutreachAttempt $record): array => [
                'outcome' => $record->outcome?->value,
                'outcome_note' => $record->outcome_note,
            ])
            ->form([
                Forms\Components\Select::make('outcome')
                    ->options(OutreachOutcome::class)
                    ->required(),
                Forms\Components\Textarea::make('outcome_note')
                    ->label('Note')
                    ->helperText('Free text — what came of it?')
                    ->rows(3),
            ])
            ->modalHeading('Record outcome')
            ->modalSubmitActionLabel('Save')
            ->action(function (OutreachAttempt $record, array $data): void {
                RecordOutreachOutcome::run(
                    $record,
                    OutreachOutcome::from($data['outcome']),
                    filled($data['outcome_note']) ? $data['outcome_note'] : null,
                );
            });
    }

    /**
     * Compose a follow-up to a sent attempt. Reuses the prospect table's compose
     * modal, resolving the prospect and the attempt being followed up from the
     * row record so the new attempt carries `follow_up_to_id`.
     */
    protected static function followUpAction(): Tables\Actions\Action
    {
        return ProspectResource::buildComposeAction(
            Tables\Actions\Action::make('followUp'),
            prospectFrom: function (Model $record): Prospect {
                assert($record instanceof OutreachAttempt);
                $prospect = $record->prospect;
                assert($prospect instanceof Prospect);

                return $prospect;
            },
            followUpFrom: function (Model $record): OutreachAttempt {
                assert($record instanceof OutreachAttempt);

                return $record;
            },
        )
            ->label('Send follow-up')
            ->icon('heroicon-o-arrow-uturn-right')
            ->modalHeading('Send follow-up')
            ->visible(fn (OutreachAttempt $record): bool => $record->isSent());
    }
}
