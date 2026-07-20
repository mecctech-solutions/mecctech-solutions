<?php

namespace App\Data;

use Spatie\LaravelData\Data;

class RenderedOutreachTemplateData extends Data
{
    public function __construct(
        public string $subject,
        public string $body,
    ) {}
}
