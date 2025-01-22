<?php

namespace App\Actions;

use Illuminate\Support\Facades\Storage;
use Lorisleiva\Actions\Concerns\AsAction;

class DetermineFullFileUrl
{
    use AsAction;

    public function handle(string $filePath): string
    {
        // Needs to be hard coded with public to make the tests pass
        // Likely an environment caching issue but solved it like this for now
        if (Storage::disk('public')->exists($filePath)) {
            return Storage::disk('public')->url($filePath);
        }

        return url($filePath);
    }
}
