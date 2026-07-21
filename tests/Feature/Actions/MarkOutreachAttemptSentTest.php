<?php

use App\Actions\MarkOutreachAttemptSent;
use App\Models\OutreachAttempt;
use Illuminate\Support\Carbon;

it('stamps an unsent attempt as sent now by default', function () {
    Carbon::setTestNow('2026-07-20 12:00:00');

    $attempt = OutreachAttempt::factory()->draft()->create();

    expect($attempt->sent_at)->toBeNull();

    MarkOutreachAttemptSent::run($attempt);

    expect($attempt->refresh()->sent_at)->not->toBeNull()
        ->and($attempt->sent_at->toDateTimeString())->toBe('2026-07-20 12:00:00');
});

it('accepts an explicit sent-at time', function () {
    $attempt = OutreachAttempt::factory()->draft()->create();
    $sentAt = Carbon::parse('2026-01-02 09:30:00');

    MarkOutreachAttemptSent::run($attempt, $sentAt);

    expect($attempt->refresh()->sent_at->toDateTimeString())->toBe('2026-01-02 09:30:00');
});
