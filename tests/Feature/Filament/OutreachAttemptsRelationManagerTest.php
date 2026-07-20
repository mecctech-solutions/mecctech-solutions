<?php

use App\Enums\OutreachOutcome;
use App\Filament\Resources\ProspectResource\Pages\EditProspect;
use App\Filament\Resources\ProspectResource\RelationManagers\OutreachAttemptsRelationManager;
use App\Models\OutreachAttempt;
use App\Models\OutreachTemplate;
use App\Models\Prospect;
use App\Models\User;
use Livewire\Livewire;

beforeEach(function () {
    $this->actingAs(User::factory()->create([
        'email' => 'florismeccanici@tutanota.com',
    ]));
});

function relationManager(Prospect $prospect)
{
    return Livewire::test(OutreachAttemptsRelationManager::class, [
        'ownerRecord' => $prospect,
        'pageClass' => EditProspect::class,
    ]);
}

it('lists the prospect attempts newest first', function () {
    $prospect = Prospect::factory()->create();

    $older = OutreachAttempt::factory()->for($prospect)->sentDaysAgo(20)->create();
    $newer = OutreachAttempt::factory()->for($prospect)->sentDaysAgo(2)->create();

    relationManager($prospect)
        ->assertCanSeeTableRecords([$newer, $older], inOrder: true);
});

it('records an outcome, note and timestamp and drops it off the follow-up filter', function () {
    $prospect = Prospect::factory()->create();
    $attempt = OutreachAttempt::factory()->for($prospect)->sentDaysAgo(20)->create();

    relationManager($prospect)
        ->callTableAction('recordOutcome', $attempt, data: [
            'outcome' => OutreachOutcome::Meeting->value,
            'outcome_note' => 'Booked a call',
        ])
        ->assertHasNoTableActionErrors();

    expect($attempt->refresh())
        ->outcome->toBe(OutreachOutcome::Meeting)
        ->outcome_note->toBe('Booked a call')
        ->outcome_at->not->toBeNull();

    relationManager($prospect)
        ->filterTable('due_for_follow_up')
        ->assertCanNotSeeTableRecords([$attempt]);
});

it('surfaces only attempts due for follow-up when the filter is applied', function () {
    $prospect = Prospect::factory()->create();

    $due = OutreachAttempt::factory()->for($prospect)->sentDaysAgo(20)->create();
    $recent = OutreachAttempt::factory()->for($prospect)->sentDaysAgo(3)->create();
    $answered = OutreachAttempt::factory()->for($prospect)->sentDaysAgo(20)
        ->withOutcome(OutreachOutcome::Negative)->create();
    $draft = OutreachAttempt::factory()->for($prospect)->draft()->create();
    $alreadyFollowedUp = OutreachAttempt::factory()->for($prospect)->sentDaysAgo(20)->create();
    OutreachAttempt::factory()->followUpTo($alreadyFollowedUp)->create();

    relationManager($prospect)
        ->filterTable('due_for_follow_up')
        ->assertCanSeeTableRecords([$due])
        ->assertCanNotSeeTableRecords([$recent, $answered, $draft, $alreadyFollowedUp]);
});

it('creates a follow-up attempt pointing at the original with the same prospect', function () {
    $prospect = Prospect::factory()->create();
    $template = OutreachTemplate::factory()->create();
    $original = OutreachAttempt::factory()->for($prospect)->sentDaysAgo(20)->create();

    relationManager($prospect)
        ->callTableAction('followUp', $original, data: [
            'outreach_template_id' => $template->id,
            'subject' => 'Following up on my earlier note',
            'body' => 'Just checking in.',
        ])
        ->assertHasNoTableActionErrors();

    $followUp = $prospect->outreachAttempts()->where('follow_up_to_id', $original->id)->sole();

    expect($followUp)
        ->prospect_id->toBe($prospect->id)
        ->follow_up_to_id->toBe($original->id)
        ->sent_at->not->toBeNull()
        ->subject->toBe('Following up on my earlier note');
});
