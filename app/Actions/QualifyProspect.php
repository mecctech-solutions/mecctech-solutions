<?php

namespace App\Actions;

use App\Enums\QualificationStatus;
use App\Models\Prospect;
use Illuminate\Support\Carbon;
use Lorisleiva\Actions\Concerns\AsAction;

class QualifyProspect
{
    use AsAction;

    /**
     * `qualified_at` is cleared when the prospect goes back to Pending so the
     * timestamp always reflects a real qualification decision rather than the
     * absence of one.
     */
    public function handle(Prospect $prospect, QualificationStatus $status, ?string $reason = null): Prospect
    {
        $prospect->qualification_status = $status;
        $prospect->qualification_reason = $reason;
        $prospect->qualified_at = $status === QualificationStatus::Pending ? null : Carbon::now();
        $prospect->save();

        return $prospect;
    }
}
