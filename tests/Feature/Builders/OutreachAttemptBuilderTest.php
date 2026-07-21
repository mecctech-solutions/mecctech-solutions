<?php

use App\Enums\OutreachOutcome;
use App\Models\OutreachAttempt;

it('filters sent attempts', function () {
    OutreachAttempt::factory()->create();
    OutreachAttempt::factory()->draft()->create();

    expect(OutreachAttempt::query()->sent()->count())->toBe(1);
});

it('filters draft attempts', function () {
    OutreachAttempt::factory()->draft()->create();
    OutreachAttempt::factory()->create();

    expect(OutreachAttempt::query()->draft()->count())->toBe(1);
});

it('filters attempts awaiting a response', function () {
    OutreachAttempt::factory()->create();
    OutreachAttempt::factory()->draft()->create();
    OutreachAttempt::factory()->withOutcome(OutreachOutcome::Negative)->create();

    expect(OutreachAttempt::query()->awaitingResponse()->count())->toBe(1);
});

it('lists attempts due for follow-up', function () {
    $due = OutreachAttempt::factory()->sentDaysAgo(15)->create();

    expect(OutreachAttempt::query()->dueForFollowUp()->pluck('id')->all())->toBe([$due->id]);
});

it('excludes unsent attempts from due for follow-up', function () {
    OutreachAttempt::factory()->draft()->create();

    expect(OutreachAttempt::query()->dueForFollowUp()->count())->toBe(0);
});

it('excludes attempts with an outcome from due for follow-up', function () {
    OutreachAttempt::factory()
        ->sentDaysAgo(15)
        ->withOutcome(OutreachOutcome::PositiveReply)
        ->create();

    expect(OutreachAttempt::query()->dueForFollowUp()->count())->toBe(0);
});

it('excludes attempts sent within the window from due for follow-up', function () {
    OutreachAttempt::factory()->sentDaysAgo(13)->create();

    expect(OutreachAttempt::query()->dueForFollowUp()->count())->toBe(0);
});

it('excludes attempts that already have a follow-up from due for follow-up', function () {
    $original = OutreachAttempt::factory()->sentDaysAgo(15)->create();
    OutreachAttempt::factory()->followUpTo($original)->sentDaysAgo(1)->create();

    expect(OutreachAttempt::query()->dueForFollowUp()->count())->toBe(0);
});

it('respects a custom follow-up window', function () {
    OutreachAttempt::factory()->sentDaysAgo(8)->create();

    expect(OutreachAttempt::query()->dueForFollowUp(7)->count())->toBe(1)
        ->and(OutreachAttempt::query()->dueForFollowUp(14)->count())->toBe(0);
});
