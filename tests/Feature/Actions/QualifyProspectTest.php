<?php

use App\Actions\QualifyProspect;
use App\Enums\QualificationStatus;
use App\Models\Prospect;

it('marks a prospect suitable with a reason and stamps qualified_at', function () {
    $prospect = Prospect::factory()->create([
        'qualification_status' => QualificationStatus::Pending,
        'qualified_at' => null,
    ]);

    $result = QualifyProspect::run($prospect, QualificationStatus::Suitable, 'Has an active vacancies page');

    expect($result->refresh())
        ->qualification_status->toBe(QualificationStatus::Suitable)
        ->qualification_reason->toBe('Has an active vacancies page')
        ->qualified_at->not->toBeNull();
});

it('marks a prospect unsuitable with a reason', function () {
    $prospect = Prospect::factory()->create();

    QualifyProspect::run($prospect, QualificationStatus::Unsuitable, 'Too large');

    expect($prospect->refresh())
        ->qualification_status->toBe(QualificationStatus::Unsuitable)
        ->qualification_reason->toBe('Too large')
        ->qualified_at->not->toBeNull();
});

it('clears qualified_at when set back to pending', function () {
    $prospect = Prospect::factory()->suitable()->create();

    expect($prospect->qualified_at)->not->toBeNull();

    QualifyProspect::run($prospect, QualificationStatus::Pending);

    expect($prospect->refresh())
        ->qualification_status->toBe(QualificationStatus::Pending)
        ->qualification_reason->toBeNull()
        ->qualified_at->toBeNull();
});

it('allows qualifying without a reason', function () {
    $prospect = Prospect::factory()->create();

    QualifyProspect::run($prospect, QualificationStatus::Suitable);

    expect($prospect->refresh())
        ->qualification_status->toBe(QualificationStatus::Suitable)
        ->qualification_reason->toBeNull()
        ->qualified_at->not->toBeNull();
});
