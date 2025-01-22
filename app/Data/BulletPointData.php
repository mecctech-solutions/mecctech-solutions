<?php

namespace App\Data;

use Spatie\LaravelData\Data;

class BulletPointData extends Data
{
    public function __construct(
        public string $text_en,
        public string $text_nl,
    ) {}
}
