<?php

use App\Enums\CompanyType;
use App\Filament\Resources\ProspectResource\Pages\ListProspects;
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

it('offers only templates matching the prospect type plus generic ones', function () {
    $prospect = Prospect::factory()->ofType(CompanyType::Agency)->create();

    $generic = OutreachTemplate::factory()->create(['name' => 'Generic Pitch']);
    $agency = OutreachTemplate::factory()->forType(CompanyType::Agency)->create(['name' => 'Agency Pitch']);
    $staffing = OutreachTemplate::factory()->forType(CompanyType::StaffingAgency)->create(['name' => 'Staffing Pitch']);

    Livewire::test(ListProspects::class)
        ->mountTableAction('compose', $prospect)
        ->assertSee($generic->name)
        ->assertSee($agency->name)
        ->assertDontSee($staffing->name);
});

it('renders the template placeholders into the editable subject and body on selection', function () {
    $prospect = Prospect::factory()->ofType(CompanyType::Agency)->create([
        'name' => 'Acme BV',
        'website' => 'https://acme.example',
        'contact_first_name' => 'Jane',
    ]);
    $template = OutreachTemplate::factory()->forType(CompanyType::Agency)->create([
        'subject' => 'A quick idea for {{company_name}}',
        'body' => 'Hi {{contact_first_name}}, about {{website}}.',
    ]);

    Livewire::test(ListProspects::class)
        ->mountTableAction('compose', $prospect)
        ->setTableActionData(['outreach_template_id' => $template->id])
        ->assertTableActionDataSet([
            'subject' => 'A quick idea for Acme BV',
            'body' => 'Hi Jane, about https://acme.example.',
        ]);
});

it('creates a sent attempt snapshotting the edited text via copy and mark as sent', function () {
    $prospect = Prospect::factory()->create();
    $template = OutreachTemplate::factory()->create();

    Livewire::test(ListProspects::class)
        ->callTableAction('compose', $prospect, data: [
            'outreach_template_id' => $template->id,
            'subject' => 'Edited subject for this prospect',
            'body' => 'Edited body, hand-tweaked before sending.',
        ])
        ->assertHasNoTableActionErrors();

    $attempt = $prospect->outreachAttempts()->sole();

    expect($attempt)
        ->sent_at->not->toBeNull()
        ->subject->toBe('Edited subject for this prospect')
        ->body->toBe('Edited body, hand-tweaked before sending.')
        ->outreach_template_id->toBe($template->id);
});

it('records no attempt when only copying', function () {
    $prospect = Prospect::factory()->create();
    $template = OutreachTemplate::factory()->create();

    Livewire::test(ListProspects::class)
        ->callTableAction('compose', $prospect, data: [
            'outreach_template_id' => $template->id,
            'subject' => 'Just looking',
            'body' => 'Not sending yet.',
        ], arguments: ['markSent' => false])
        ->assertHasNoTableActionErrors();

    expect(OutreachAttempt::query()->count())->toBe(0);
});

it('does not rewrite a sent attempt when the template is edited afterwards', function () {
    $prospect = Prospect::factory()->create();
    $template = OutreachTemplate::factory()->create();

    Livewire::test(ListProspects::class)
        ->callTableAction('compose', $prospect, data: [
            'outreach_template_id' => $template->id,
            'subject' => 'Snapshot subject',
            'body' => 'Snapshot body.',
        ])
        ->assertHasNoTableActionErrors();

    $template->update([
        'subject' => 'Rewritten subject',
        'body' => 'Rewritten body.',
    ]);

    expect($prospect->outreachAttempts()->sole())
        ->subject->toBe('Snapshot subject')
        ->body->toBe('Snapshot body.');
});
