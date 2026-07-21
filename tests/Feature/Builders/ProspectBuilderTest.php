<?php

use App\Enums\CompanyType;
use App\Models\Prospect;

it('filters prospects pending qualification', function () {
    Prospect::factory()->create();
    Prospect::factory()->suitable()->create();
    Prospect::factory()->unsuitable()->create();

    expect(Prospect::query()->pendingQualification()->count())->toBe(1);
});

it('filters suitable prospects', function () {
    Prospect::factory()->suitable()->create();
    Prospect::factory()->unsuitable()->create();
    Prospect::factory()->create();

    expect(Prospect::query()->suitable()->count())->toBe(1);
});

it('filters unsuitable prospects', function () {
    Prospect::factory()->unsuitable()->create();
    Prospect::factory()->suitable()->create();
    Prospect::factory()->create();

    expect(Prospect::query()->unsuitable()->count())->toBe(1);
});

it('filters prospects by company type', function () {
    Prospect::factory()->ofType(CompanyType::Agency)->create();
    Prospect::factory()->ofType(CompanyType::StaffingAgency)->create();

    expect(Prospect::query()->ofType(CompanyType::Agency)->count())->toBe(1);
});

it('searches prospects by name, domain and contact', function () {
    Prospect::factory()->create(['name' => 'Acme Widgets', 'website' => 'https://acme-widgets.test']);
    Prospect::factory()->create(['name' => 'Other Corp', 'website' => 'https://other.test']);

    expect(Prospect::query()->search('acme')->count())->toBe(1)
        ->and(Prospect::query()->search('acme-widgets.test')->count())->toBe(1);
});
