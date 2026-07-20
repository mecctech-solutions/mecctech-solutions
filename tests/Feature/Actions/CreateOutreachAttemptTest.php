<?php

use App\Actions\CreateOutreachAttempt;
use App\Models\OutreachTemplate;
use App\Models\Prospect;

it('creates an unsent attempt with the rendered template as a snapshot', function () {
    $prospect = Prospect::factory()->create([
        'name' => 'Acme BV',
        'website' => 'https://acme.example',
        'contact_first_name' => 'Jane',
    ]);
    $template = OutreachTemplate::factory()->create([
        'subject' => 'A quick idea for {{company_name}}',
        'body' => 'Hi {{contact_first_name}}, about {{website}}.',
    ]);

    $attempt = CreateOutreachAttempt::run($prospect, $template);

    expect($attempt->refresh())
        ->prospect_id->toBe($prospect->id)
        ->outreach_template_id->toBe($template->id)
        ->sent_at->toBeNull()
        ->subject->toBe('A quick idea for Acme BV')
        ->body->toBe('Hi Jane, about https://acme.example.');
});

it('snapshots the edited subject and body when supplied', function () {
    $prospect = Prospect::factory()->create();
    $template = OutreachTemplate::factory()->create();

    $attempt = CreateOutreachAttempt::run(
        $prospect,
        $template,
        subject: 'Hand-tweaked subject',
        body: 'Hand-tweaked body specific to this prospect.',
    );

    expect($attempt->refresh())
        ->subject->toBe('Hand-tweaked subject')
        ->body->toBe('Hand-tweaked body specific to this prospect.');
});

it('does not rewrite the snapshot when the template is later edited', function () {
    $prospect = Prospect::factory()->create();
    $template = OutreachTemplate::factory()->create([
        'subject' => 'Original subject',
        'body' => 'Original body.',
    ]);

    $attempt = CreateOutreachAttempt::run($prospect, $template);

    $template->update([
        'subject' => 'Rewritten subject',
        'body' => 'Rewritten body.',
    ]);

    expect($attempt->refresh())
        ->subject->toBe('Original subject')
        ->body->toBe('Original body.');
});

it('keeps the snapshot when the template is deleted', function () {
    $prospect = Prospect::factory()->create();
    $template = OutreachTemplate::factory()->create([
        'subject' => 'Snapshot subject',
        'body' => 'Snapshot body.',
    ]);

    $attempt = CreateOutreachAttempt::run($prospect, $template);

    $template->delete();

    expect($attempt->refresh())
        ->outreach_template_id->toBeNull()
        ->subject->toBe('Snapshot subject')
        ->body->toBe('Snapshot body.');
});

it('links a follow-up to the attempt it follows up on', function () {
    $prospect = Prospect::factory()->create();
    $template = OutreachTemplate::factory()->create();
    $first = CreateOutreachAttempt::run($prospect, $template);

    $followUp = CreateOutreachAttempt::run($prospect, $template, followUpTo: $first);

    expect($followUp->refresh())
        ->follow_up_to_id->toBe($first->id)
        ->prospect_id->toBe($prospect->id);
});
