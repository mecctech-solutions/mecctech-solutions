<?php

use App\Enums\CompanyType;
use App\Enums\QualificationStatus;
use App\Filament\Resources\ProspectResource\Pages\CreateProspect;
use App\Filament\Resources\ProspectResource\Pages\ListProspects;
use App\Models\Prospect;
use App\Models\User;
use Livewire\Livewire;

beforeEach(function () {
    $this->actingAs(User::factory()->create([
        'email' => 'florismeccanici@tutanota.com',
    ]));
});

it('shows only pending prospects by default', function () {
    $pending = Prospect::factory()->create();
    $suitable = Prospect::factory()->suitable()->create();
    $unsuitable = Prospect::factory()->unsuitable()->create();

    Livewire::test(ListProspects::class)
        ->assertCanSeeTableRecords([$pending])
        ->assertCanNotSeeTableRecords([$suitable, $unsuitable]);
});

it('can show all prospects when the default filter is cleared', function () {
    $pending = Prospect::factory()->create();
    $suitable = Prospect::factory()->suitable()->create();

    Livewire::test(ListProspects::class)
        ->removeTableFilter('qualification_status')
        ->assertCanSeeTableRecords([$pending, $suitable]);
});

it('searches prospects by name, domain and contact email', function () {
    $target = Prospect::factory()->create([
        'name' => 'Needle Corp',
        'website' => 'https://needle-corp.example',
        'contact_email' => 'someone@needle-corp.example',
    ]);
    $other = Prospect::factory()->create(['name' => 'Haystack BV']);

    Livewire::test(ListProspects::class)
        ->searchTable('Needle')
        ->assertCanSeeTableRecords([$target])
        ->assertCanNotSeeTableRecords([$other])
        ->searchTable($target->domain)
        ->assertCanSeeTableRecords([$target])
        ->assertCanNotSeeTableRecords([$other])
        ->searchTable('someone@needle-corp.example')
        ->assertCanSeeTableRecords([$target])
        ->assertCanNotSeeTableRecords([$other]);
});

it('qualifies a prospect through the row action and drops it from the default view', function () {
    $prospect = Prospect::factory()->create();

    Livewire::test(ListProspects::class)
        ->assertCanSeeTableRecords([$prospect])
        ->callTableAction('qualify', $prospect, data: [
            'qualification_status' => QualificationStatus::Suitable->value,
            'qualification_reason' => 'Has an active vacancies page',
        ])
        ->assertHasNoTableActionErrors()
        ->assertCanNotSeeTableRecords([$prospect]);

    expect($prospect->refresh())
        ->qualification_status->toBe(QualificationStatus::Suitable)
        ->qualification_reason->toBe('Has an active vacancies page')
        ->qualified_at->not->toBeNull();
});

it('clears qualified_at when the row action sets a prospect back to pending', function () {
    $prospect = Prospect::factory()->suitable()->create();

    Livewire::test(ListProspects::class)
        ->removeTableFilter('qualification_status')
        ->callTableAction('qualify', $prospect, data: [
            'qualification_status' => QualificationStatus::Pending->value,
            'qualification_reason' => null,
        ])
        ->assertHasNoTableActionErrors();

    expect($prospect->refresh())
        ->qualification_status->toBe(QualificationStatus::Pending)
        ->qualified_at->toBeNull();
});

it('derives the domain from the website when creating a prospect', function () {
    Livewire::test(CreateProspect::class)
        ->fillForm([
            'name' => 'Acme',
            'type' => CompanyType::Agency->value,
            'website' => 'https://www.Acme.NL/vacatures',
        ])
        ->call('create')
        ->assertHasNoFormErrors();

    expect(Prospect::query()->where('name', 'Acme')->first())
        ->not->toBeNull()
        ->domain->toBe('acme.nl')
        ->website->toBe('https://www.Acme.NL/vacatures');
});
