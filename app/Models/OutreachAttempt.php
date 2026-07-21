<?php

namespace App\Models;

use App\Builders\OutreachAttemptBuilder;
use App\Enums\OutreachOutcome;
use Carbon\CarbonInterface;
use Database\Factories\OutreachAttemptFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Query\Builder;

/**
 * @property string $subject
 * @property string $body
 * @property CarbonInterface|null $sent_at
 * @property OutreachOutcome|null $outcome
 * @property string|null $outcome_note
 * @property CarbonInterface|null $outcome_at
 */
class OutreachAttempt extends Model
{
    /** @use HasFactory<OutreachAttemptFactory> */
    use HasFactory;

    protected $fillable = [
        'prospect_id',
        'outreach_template_id',
        'follow_up_to_id',
        'subject',
        'body',
        'sent_at',
        'outcome',
        'outcome_note',
        'outcome_at',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'sent_at' => 'datetime',
            'outcome' => OutreachOutcome::class,
            'outcome_at' => 'datetime',
        ];
    }

    public function isSent(): bool
    {
        return $this->sent_at !== null;
    }

    public function isAwaitingResponse(): bool
    {
        return $this->isSent() && $this->outcome === null;
    }

    /**
     * @return BelongsTo<Prospect, $this>
     */
    public function prospect(): BelongsTo
    {
        return $this->belongsTo(Prospect::class);
    }

    /**
     * @return BelongsTo<OutreachTemplate, $this>
     */
    public function outreachTemplate(): BelongsTo
    {
        return $this->belongsTo(OutreachTemplate::class);
    }

    /**
     * @return BelongsTo<OutreachAttempt, $this>
     */
    public function followUpTo(): BelongsTo
    {
        return $this->belongsTo(OutreachAttempt::class, 'follow_up_to_id');
    }

    /**
     * @return HasMany<OutreachAttempt, $this>
     */
    public function followUps(): HasMany
    {
        return $this->hasMany(OutreachAttempt::class, 'follow_up_to_id');
    }

    /**
     * @param  Builder  $query
     */
    public function newEloquentBuilder($query): OutreachAttemptBuilder
    {
        return new OutreachAttemptBuilder($query);
    }

    protected static function newFactory(): OutreachAttemptFactory
    {
        return OutreachAttemptFactory::new();
    }
}
