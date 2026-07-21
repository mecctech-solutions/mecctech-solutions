<?php

use App\Actions\RecordOutreachOutcome;
use App\Enums\OutreachOutcome;
use App\Models\OutreachAttempt;
use Illuminate\Support\Carbon;

it('records the outcome, note and timestamp on a sent attempt', function () {
    Carbon::setTestNow('2026-07-20 12:00:00');

    $attempt = OutreachAttempt::factory()->sentDaysAgo(20)->create();

    expect($attempt->outcome)->toBeNull();

    $result = RecordOutreachOutcome::run($attempt, OutreachOutcome::Meeting, 'Booked a call for next week');

    expect($result->refresh())
        ->outcome->toBe(OutreachOutcome::Meeting)
        ->outcome_note->toBe('Booked a call for next week')
        ->and($result->outcome_at->toDateTimeString())->toBe('2026-07-20 12:00:00');
});

it('allows recording an outcome without a note', function () {
    $attempt = OutreachAttempt::factory()->sentDaysAgo(20)->create();

    RecordOutreachOutcome::run($attempt, OutreachOutcome::Negative);

    expect($attempt->refresh())
        ->outcome->toBe(OutreachOutcome::Negative)
        ->outcome_note->toBeNull()
        ->outcome_at->not->toBeNull();
});

it('drops the attempt off the due-for-follow-up list once an outcome is recorded', function () {
    $attempt = OutreachAttempt::factory()->sentDaysAgo(20)->create();

    expect(OutreachAttempt::query()->dueForFollowUp()->pluck('id'))->toContain($attempt->id);

    RecordOutreachOutcome::run($attempt, OutreachOutcome::PositiveReply);

    expect(OutreachAttempt::query()->dueForFollowUp()->pluck('id'))->not->toContain($attempt->id);
});
