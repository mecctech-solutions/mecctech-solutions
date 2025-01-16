<?php

namespace App\Actions;

use Lorisleiva\Actions\Concerns\AsAction;

class DetermineFullFileUrl
{
    use AsAction;

    public function handle(string $filePath): string
    {
        if (\Storage::exists($filePath)) {
            return \Storage::url($filePath);
        }

        return url($filePath);
    }
}
