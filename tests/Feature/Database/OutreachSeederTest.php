<?php

use App\Enums\CompanyType;
use App\Enums\OutreachOutcome;
use App\Enums\QualificationStatus;
use App\Models\OutreachAttempt;
use App\Models\OutreachTemplate;
use App\Models\Prospect;
use Database\Seeders\OutreachTemplateSeeder;
use Database\Seeders\ProspectSeeder;

it('seeds a starter template for every company type with an opt-out sentence', function () {
    $this->seed(OutreachTemplateSeeder::class);

    foreach (CompanyType::cases() as $type) {
        $template = OutreachTemplate::query()->where('company_type', $type)->first();

        expect($template)->not->toBeNull()
            ->and($template->subject)->toContain('{{company_name}}')
            ->and($template->body)->toContain('{{contact_first_name}}')
            ->and($template->body)->toContain('{{website}}')
            ->and($template->body)->toContain('uit mijn lijst');
    }
});

it('seeds a populated qualification queue across all statuses', function () {
    $this->seed(OutreachTemplateSeeder::class);
    $this->seed(ProspectSeeder::class);

    expect(Prospect::query()->where('qualification_status', QualificationStatus::Pending)->count())->toBeGreaterThan(0)
        ->and(Prospect::query()->where('qualification_status', QualificationStatus::Suitable)->count())->toBeGreaterThan(0)
        ->and(Prospect::query()->where('qualification_status', QualificationStatus::Unsuitable)->count())->toBeGreaterThan(0);

    foreach (CompanyType::cases() as $type) {
        expect(Prospect::query()->where('type', $type)->count())->toBeGreaterThan(0);
    }
});

it('seeds attempts in every state', function () {
    $this->seed(OutreachTemplateSeeder::class);
    $this->seed(ProspectSeeder::class);

    expect(OutreachAttempt::query()->awaitingResponse()->count())->toBeGreaterThan(0)
        ->and(OutreachAttempt::query()->dueForFollowUp()->count())->toBeGreaterThan(0)
        ->and(OutreachAttempt::query()->whereNotNull('follow_up_to_id')->count())->toBeGreaterThan(0);

    foreach (OutreachOutcome::cases() as $outcome) {
        expect(OutreachAttempt::query()->where('outcome', $outcome)->count())->toBeGreaterThan(0);
    }
});

it('snapshots the matching template onto seeded attempts', function () {
    $this->seed(OutreachTemplateSeeder::class);
    $this->seed(ProspectSeeder::class);

    $attempt = OutreachAttempt::query()->whereNotNull('outreach_template_id')->first();

    expect($attempt)->not->toBeNull()
        ->and($attempt->subject)->not->toContain('{{')
        ->and($attempt->subject)->toContain($attempt->prospect->name);
});

it('is idempotent and never crashes on the unique domain index', function () {
    $this->seed(OutreachTemplateSeeder::class);
    $this->seed(ProspectSeeder::class);

    $prospectCount = Prospect::query()->count();
    $templateCount = OutreachTemplate::query()->count();

    $this->seed(OutreachTemplateSeeder::class);
    $this->seed(ProspectSeeder::class);

    expect(Prospect::query()->count())->toBe($prospectCount)
        ->and(OutreachTemplate::query()->count())->toBe($templateCount);
});

it('leaves imported prospects untouched when re-seeding', function () {
    $imported = Prospect::factory()->create(['website' => 'https://acme.nl']);

    $this->seed(OutreachTemplateSeeder::class);
    $this->seed(ProspectSeeder::class);
    $this->seed(ProspectSeeder::class);

    expect(Prospect::query()->whereKey($imported->id)->exists())->toBeTrue();
});
