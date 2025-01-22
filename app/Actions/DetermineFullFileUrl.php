<?php

namespace App\Actions;

use Illuminate\Support\Facades\Storage;
use Lorisleiva\Actions\Concerns\AsAction;

class DetermineFullFileUrl
{
    use AsAction;

    public function handle(string $filePath): string
    {
        if (Storage::disk('public')->exists($filePath)) {
            return Storage::disk('public')->url($filePath);
        }

        return url($filePath);
    }
}
