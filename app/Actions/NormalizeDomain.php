<?php

namespace App\Actions;

use Illuminate\Support\Str;
use Lorisleiva\Actions\Concerns\AsAction;

class NormalizeDomain
{
    use AsAction;

    /**
     * The canonical host is the unique dedupe key for prospects, so it must be
     * deterministic for every caller (Filament form, CSV import, seeders).
     */
    public function handle(string $input): string
    {
        $value = trim($input);

        if ($value === '') {
            return '';
        }

        if (! Str::contains($value, '//')) {
            $value = 'https://'.$value;
        }

        $host = parse_url($value, PHP_URL_HOST) ?: '';

        if ($host === '') {
            $host = $value;
        }

        $host = Str::of($host)
            ->lower()
            ->trim()
            ->trim('.');

        if ($host->startsWith('www.')) {
            $host = $host->after('www.');
        }

        return $host->toString();
    }
}
