<?php

namespace App\Filament\Imports;

use App\Actions\NormalizeDomain;
use App\Enums\CompanyType;
use App\Models\Prospect;
use Filament\Actions\Imports\Exceptions\RowImportFailedException;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;
use Illuminate\Support\Str;

class ProspectImporter extends Importer
{
    protected static ?string $model = Prospect::class;

    /**
     * @return array<int, ImportColumn>
     */
    public static function getColumns(): array
    {
        return [
            ImportColumn::make('name')
                ->label('Company')
                ->guess(['Company', 'Name'])
                ->requiredMapping()
                ->rules(['required', 'string', 'max:255']),
            ImportColumn::make('website')
                ->label('Website')
                ->guess(['Website', 'URL'])
                ->ignoreBlankState()
                ->rules(['nullable', 'string', 'max:255']),
            ImportColumn::make('type')
                ->label('Type')
                ->guess(['Type'])
                ->requiredMapping()
                ->castStateUsing(function (?string $state): string {
                    if (blank($state)) {
                        throw new RowImportFailedException('A company type is required (Agency, Direct client or Staffing agency).');
                    }

                    $type = self::resolveCompanyType($state);

                    if ($type === null) {
                        throw new RowImportFailedException("\"{$state}\" is not a recognised company type. Use Agency, Direct client or Staffing agency.");
                    }

                    return $type->value;
                }),
            ImportColumn::make('contact_first_name')
                ->label('Contact first name')
                ->guess(['First Name'])
                ->ignoreBlankState()
                ->rules(['nullable', 'string', 'max:255']),
            ImportColumn::make('contact_last_name')
                ->label('Contact last name')
                ->guess(['Last Name'])
                ->ignoreBlankState()
                ->rules(['nullable', 'string', 'max:255']),
            ImportColumn::make('contact_email')
                ->label('Contact email')
                ->guess(['Email'])
                ->ignoreBlankState()
                ->rules(['nullable', 'email', 'max:255']),
            ImportColumn::make('notes')
                ->label('Notes')
                ->guess(['Opmerkingen', 'Notes'])
                ->ignoreBlankState()
                ->rules(['nullable', 'string']),
        ];
    }

    public function resolveRecord(): ?Prospect
    {
        return Prospect::firstOrNew([
            'domain' => NormalizeDomain::run($this->data['website'] ?? $this->data['domain'] ?? ''),
        ]);
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your prospect import has completed and '.number_format($import->successful_rows).' '.str('row')->plural($import->successful_rows).' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' '.number_format($failedRowsCount).' '.str('row')->plural($failedRowsCount).' failed to import.';
        }

        return $body;
    }

    /**
     * Map the sheet's free-text "Type" column onto the CompanyType enum. The
     * taxonomy predates the enum, so both English labels and the Dutch terms
     * from the original Excel sheet are accepted. Unknown values return null so
     * the caller can fail the row rather than silently defaulting.
     */
    private static function resolveCompanyType(string $value): ?CompanyType
    {
        $normalized = Str::of($value)
            ->lower()
            ->replace(['-', '_'], ' ')
            ->squish()
            ->toString();

        return match ($normalized) {
            'agency', 'bureau', 'reclamebureau', 'marketingbureau', 'webbureau' => CompanyType::Agency,
            'direct client', 'direct', 'client', 'directe klant', 'klant', 'eindklant' => CompanyType::DirectClient,
            'staffing agency', 'staffing', 'uitzendbureau', 'detachering', 'detacheringsbureau', 'recruitment', 'recruiter' => CompanyType::StaffingAgency,
            default => CompanyType::tryFrom($normalized) ?? CompanyType::tryFrom(str_replace(' ', '_', $normalized)),
        };
    }
}
