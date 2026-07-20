<?php

use App\Enums\CompanyType;
use App\Filament\Resources\OutreachTemplateResource\Pages\CreateOutreachTemplate;
use App\Filament\Resources\OutreachTemplateResource\Pages\EditOutreachTemplate;
use App\Models\OutreachTemplate;
use App\Models\User;
use Livewire\Livewire;

beforeEach(function () {
    $this->actingAs(User::factory()->create([
        'email' => 'florismeccanici@tutanota.com',
    ]));
});

it('creates a template through the panel', function () {
    Livewire::test(CreateOutreachTemplate::class)
        ->fillForm([
            'name' => 'Agency intro',
            'company_type' => CompanyType::Agency->value,
            'subject' => 'A quick idea for {{company_name}}',
            'body' => 'Hi {{contact_first_name}}, I saw {{website}}.',
        ])
        ->call('create')
        ->assertHasNoFormErrors();

    expect(OutreachTemplate::query()->where('name', 'Agency intro')->first())
        ->not->toBeNull()
        ->company_type->toBe(CompanyType::Agency);
});

it('persists a null company_type as a generic template', function () {
    Livewire::test(CreateOutreachTemplate::class)
        ->fillForm([
            'name' => 'Generic intro',
            'company_type' => null,
            'subject' => 'Hello {{company_name}}',
            'body' => 'Hi {{contact_first_name}}.',
        ])
        ->call('create')
        ->assertHasNoFormErrors();

    expect(OutreachTemplate::query()->where('name', 'Generic intro')->first()->company_type)
        ->toBeNull();
});

it('requires name, subject and body', function () {
    Livewire::test(CreateOutreachTemplate::class)
        ->fillForm([
            'name' => null,
            'subject' => null,
            'body' => null,
        ])
        ->call('create')
        ->assertHasFormErrors([
            'name' => 'required',
            'subject' => 'required',
            'body' => 'required',
        ]);
});

it('edits an existing template', function () {
    $template = OutreachTemplate::factory()->forType(CompanyType::Agency)->create();

    Livewire::test(EditOutreachTemplate::class, ['record' => $template->getKey()])
        ->fillForm([
            'name' => 'Updated name',
            'company_type' => null,
            'subject' => 'Updated subject',
            'body' => 'Updated body for {{domain}}.',
        ])
        ->call('save')
        ->assertHasNoFormErrors();

    expect($template->refresh())
        ->name->toBe('Updated name')
        ->company_type->toBeNull()
        ->subject->toBe('Updated subject');
});
