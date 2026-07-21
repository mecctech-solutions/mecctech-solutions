<?php

use App\Enums\CompanyType;
use App\Enums\QualificationStatus;
use App\Models\Prospect;
use Illuminate\Database\QueryException;

it('derives the domain from the website, dropping scheme, www and path', function () {
    $prospect = Prospect::factory()->create([
        'website' => 'https://www.Example.NL/vacatures',
    ]);

    expect($prospect->domain)->toBe('example.nl')
        ->and($prospect->website)->toBe('https://www.Example.NL/vacatures');
});

it('recomputes the domain when the website changes', function () {
    $prospect = Prospect::factory()->create([
        'website' => 'https://www.example.nl/vacatures',
    ]);

    $prospect->update(['website' => 'https://other-company.com/contact']);

    expect($prospect->fresh()->domain)->toBe('other-company.com');
});

it('normalises a domain supplied without a website', function () {
    $prospect = Prospect::factory()->create([
        'website' => null,
        'domain' => 'WWW.Domain-Only.NL',
    ]);

    expect($prospect->domain)->toBe('domain-only.nl');
});

it('collapses deep links of the same company onto one domain', function () {
    $vacatures = Prospect::factory()->create(['website' => 'https://example.nl/vacatures']);
    $contact = Prospect::factory()->make(['website' => 'https://example.nl/contact']);

    expect($vacatures->domain)->toBe('example.nl');
    expect(fn () => $contact->save())->toThrow(QueryException::class);
});

it('round-trips enum casts through the database', function () {
    $prospect = Prospect::factory()->create([
        'type' => CompanyType::StaffingAgency,
        'qualification_status' => QualificationStatus::Suitable,
    ]);

    $fresh = $prospect->fresh();

    expect($fresh->type)->toBe(CompanyType::StaffingAgency)
        ->and($fresh->qualification_status)->toBe(QualificationStatus::Suitable);
});
