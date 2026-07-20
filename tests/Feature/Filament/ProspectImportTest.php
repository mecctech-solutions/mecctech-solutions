<?php

use App\Enums\CompanyType;
use App\Enums\QualificationStatus;
use App\Filament\Imports\ProspectImporter;
use App\Filament\Resources\ProspectResource\Pages\ListProspects;
use App\Models\Prospect;
use App\Models\User;
use Filament\Actions\Imports\Jobs\ImportCsv;
use Filament\Actions\Imports\Models\Import;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Log;
use League\Csv\Reader;
use Livewire\Livewire;

/**
 * Run the operator's fixture CSV through the exact pipeline Filament's
 * ImportAction uses per chunk: read the file, map the sheet's headers onto the
 * importer's columns and dispatch the ImportCsv job inline (the app runs on the
 * sync queue).
 */
function runProspectImport(?array $rows = null): Import
{
    if ($rows === null) {
        $reader = Reader::createFromPath(base_path('tests/Fixtures/prospects.csv'));
        $reader->setHeaderOffset(0);

        $rows = iterator_to_array($reader->getRecords(), false);
    }

    $columnMap = [
        'name' => 'Company',
        'website' => 'Website',
        'type' => 'Type',
        'contact_first_name' => 'First Name',
        'contact_last_name' => 'Last Name',
        'contact_email' => 'Email',
        'notes' => 'Opmerkingen',
    ];

    $import = Import::create([
        'user_id' => User::factory()->create()->id,
        'file_name' => 'prospects.csv',
        'file_path' => 'prospects.csv',
        'importer' => ProspectImporter::class,
        'total_rows' => count($rows),
    ]);

    (new ImportCsv($import, $rows, $columnMap))->handle();

    return $import->refresh();
}

it('imports the operator\'s CSV, mapping its headers onto prospects', function () {
    runProspectImport();

    $acme = Prospect::query()->where('domain', 'acme.nl')->first();

    expect($acme)->not->toBeNull()
        ->name->toBe('Acme Agency')
        ->website->toBe('http://acme.nl')
        ->type->toBe(CompanyType::Agency)
        ->contact_first_name->toBe('Anna')
        ->contact_email->toBe('anna@acme.example')
        ->qualification_status->toBe(QualificationStatus::Pending);

    $staffing = Prospect::query()->where('domain', 'staffing.example')->first();

    expect($staffing)->not->toBeNull()
        ->type->toBe(CompanyType::StaffingAgency)
        ->qualification_status->toBe(QualificationStatus::Pending);
});

it('does not import the legacy Sent or Geschikt columns', function () {
    runProspectImport();

    expect(Prospect::query()->where('qualification_status', '!=', QualificationStatus::Pending->value)->count())->toBe(0)
        ->and(Prospect::query()->whereHas('outreachAttempts')->count())->toBe(0);
});

it('deduplicates on the normalised domain and never overwrites a value with a blank cell', function () {
    runProspectImport();

    // Row 1 (https://www.Acme.NL/vacatures) and row 2 (http://acme.nl) are the
    // same company: one prospect, updated in place, never duplicated.
    expect(Prospect::query()->where('domain', 'acme.nl')->count())->toBe(1);

    $acme = Prospect::query()->where('domain', 'acme.nl')->first();

    // Row 2 left First Name / Email blank, so the values from row 1 survive...
    expect($acme->contact_first_name)->toBe('Anna')
        ->and($acme->contact_last_name)->toBe('Jansen')
        ->and($acme->contact_email)->toBe('anna@acme.example')
        // ...while the note it did carry updated the record.
        ->and($acme->notes)->toBe('Updated note after a follow-up');
});

it('re-importing the same CSV creates zero duplicates', function () {
    runProspectImport();
    $countAfterFirst = Prospect::count();

    runProspectImport();

    expect(Prospect::count())->toBe($countAfterFirst);
});

it('fails a row with an unmappable type and lands it in failed_import_rows while others import', function () {
    $import = runProspectImport();

    expect(Prospect::query()->where('name', 'Weird Co')->exists())->toBeFalse()
        ->and($import->successful_rows)->toBe(3)
        ->and($import->getFailedRowsCount())->toBe(1);

    $failedRow = $import->failedRows()->first();

    expect($failedRow)->not->toBeNull()
        ->and($failedRow->validation_error)->toContain('not a recognised company type')
        ->and($failedRow->data['Company'])->toBe('Weird Co');
});

it('fails every row without a resolvable domain instead of colliding them on the unique constraint', function () {
    Log::spy();

    $import = runProspectImport([
        prospectRow(company: 'No Website One', website: ''),
        prospectRow(company: 'No Website Two', website: '   '),
        prospectRow(company: 'Good Co', website: 'https://good.example'),
    ]);

    expect($import->successful_rows)->toBe(1)
        ->and($import->getFailedRowsCount())->toBe(2)
        ->and(Prospect::query()->where('domain', '')->exists())->toBeFalse()
        ->and(Prospect::query()->where('domain', 'good.example')->exists())->toBeTrue();

    expect($import->failedRows()->pluck('validation_error')->all())
        ->each->toContain('No website or domain could be resolved');

    expect($import->failedRows()->get()->pluck('data.Company')->all())
        ->toEqualCanonicalizing(['No Website One', 'No Website Two']);

    Log::shouldHaveReceived('warning')
        ->withArgs(fn (string $message, array $context): bool => str_contains($message, 'no domain could be resolved')
            && $context['company'] === 'No Website One')
        ->once();
});

it('imports through the ImportAction, which dispatches a job batch', function () {
    $this->actingAs(User::factory()->create());

    Livewire::test(ListProspects::class)
        ->callAction('import', data: [
            'file' => UploadedFile::fake()->createWithContent(
                'prospects.csv',
                file_get_contents(base_path('tests/Fixtures/prospects.csv')),
            ),
            'columnMap' => [
                'name' => 'Company',
                'website' => 'Website',
                'type' => 'Type',
                'contact_first_name' => 'First Name',
                'contact_last_name' => 'Last Name',
                'contact_email' => 'Email',
                'notes' => 'Opmerkingen',
            ],
        ])
        ->assertHasNoActionErrors();

    expect(Prospect::query()->where('domain', 'acme.nl')->exists())->toBeTrue();
});

/**
 * @return array<string, string>
 */
function prospectRow(string $company, string $website): array
{
    return [
        'First Name' => '',
        'Last Name' => '',
        'Company' => $company,
        'Email' => '',
        'Website' => $website,
        'Type' => 'Agency',
        'Sent' => '',
        'Opmerkingen' => '',
        'Geschikt' => '',
    ];
}
