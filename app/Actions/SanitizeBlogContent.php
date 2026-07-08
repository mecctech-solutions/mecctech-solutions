<?php

namespace App\Actions;

use Lorisleiva\Actions\Concerns\AsAction;
use Mews\Purifier\Facades\Purifier;

class SanitizeBlogContent
{
    use AsAction;

    public function handle(string $html): string
    {
        return Purifier::clean($html);
    }
}
