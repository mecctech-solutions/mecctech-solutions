<?php

use App\Actions\CountOutreachPerDay;
use App\Models\OutreachAttempt;
use Illuminate\Support\Carbon;

beforeEach(function () {
    Carbon::setTestNow('2026-07-21 12:00:00');
});

it('returns one zero-filled bucket per day in the window', function () {
    $daily = CountOutreachPerDay::run();

    expect($daily)->toHaveCount(CountOutreachPerDay::DEFAULT_DAYS)
        ->and($daily->last()->date->toDateString())->toBe('2026-07-21')
        ->and($daily->first()->date->toDateString())->toBe('2026-06-22')
        ->and($daily->sum('count'))->toBe(0);
});

it('counts sent attempts on their Amsterdam calendar day', function () {
    OutreachAttempt::factory()->create(['sent_at' => '2026-07-21 09:00:00']);
    OutreachAttempt::factory()->create(['sent_at' => '2026-07-20 09:00:00']);
    OutreachAttempt::factory()->create(['sent_at' => '2026-07-20 15:00:00']);

    $daily = CountOutreachPerDay::run()->keyBy(fn ($day) => $day->date->toDateString());

    expect($daily->get('2026-07-21')->count)->toBe(1)
        ->and($daily->get('2026-07-20')->count)->toBe(2)
        ->and($daily->get('2026-06-30')->count)->toBe(0);
});

it('buckets by local midnight rather than the stored UTC day', function () {
    OutreachAttempt::factory()->create(['sent_at' => '2026-07-20 23:30:00']);

    $daily = CountOutreachPerDay::run()->keyBy(fn ($day) => $day->date->toDateString());

    expect($daily->get('2026-07-21')->count)->toBe(1)
        ->and($daily->get('2026-07-20')->count)->toBe(0);
});

it('ignores drafts and attempts outside the window', function () {
    OutreachAttempt::factory()->draft()->create();
    OutreachAttempt::factory()->create(['sent_at' => '2026-06-01 09:00:00']);

    expect(CountOutreachPerDay::run()->sum('count'))->toBe(0);
});

it('counts follow-ups as their own outreach', function () {
    $original = OutreachAttempt::factory()->create(['sent_at' => '2026-07-21 08:00:00']);
    OutreachAttempt::factory()->followUpTo($original)->create(['sent_at' => '2026-07-21 16:00:00']);

    $today = CountOutreachPerDay::run()->last();

    expect($today->date->toDateString())->toBe('2026-07-21')
        ->and($today->count)->toBe(2);
});
