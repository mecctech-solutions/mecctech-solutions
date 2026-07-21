<?php

use App\Enums\OutreachOutcome;
use App\Models\OutreachAttempt;

it('reports a sent attempt as sent', function () {
    expect(OutreachAttempt::factory()->create()->isSent())->toBeTrue()
        ->and(OutreachAttempt::factory()->draft()->create()->isSent())->toBeFalse();
});

it('is awaiting a response only when sent and without an outcome', function () {
    expect(OutreachAttempt::factory()->create()->isAwaitingResponse())->toBeTrue()
        ->and(OutreachAttempt::factory()->draft()->create()->isAwaitingResponse())->toBeFalse()
        ->and(
            OutreachAttempt::factory()
                ->withOutcome(OutreachOutcome::Meeting)
                ->create()
                ->isAwaitingResponse()
        )->toBeFalse();
});

it('links follow-ups to the attempt they chase', function () {
    $original = OutreachAttempt::factory()->create();
    $followUp = OutreachAttempt::factory()->followUpTo($original)->create();

    expect($followUp->followUpTo->is($original))->toBeTrue()
        ->and($original->followUps->pluck('id')->all())->toBe([$followUp->id])
        ->and($followUp->prospect_id)->toBe($original->prospect_id);
});
