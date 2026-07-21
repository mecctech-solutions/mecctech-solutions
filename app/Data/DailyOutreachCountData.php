<?php

namespace App\Data;

use Illuminate\Support\Carbon;
use Spatie\LaravelData\Data;

class DailyOutreachCountData extends Data
{
    public function __construct(
        public Carbon $date,
        public int $count,
    ) {}
}
