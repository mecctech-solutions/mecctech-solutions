<?php

namespace App\Actions;

use App\Enums\OutreachOutcome;
use App\Models\OutreachAttempt;
use Illuminate\Support\Carbon;
use Lorisleiva\Actions\Concerns\AsAction;

class RecordOutreachOutcome
{
    use AsAction;

    /**
     * `outcome` staying null means "no response yet": absence of a reply is a
     * time query, not a status anyone ticks, so there is deliberately no
     * `NoResponse` case to set here.
     */
    public function handle(OutreachAttempt $attempt, OutreachOutcome $outcome, ?string $note = null): OutreachAttempt
    {
        $attempt->outcome = $outcome;
        $attempt->outcome_note = $note;
        $attempt->outcome_at = Carbon::now();
        $attempt->save();

        return $attempt;
    }
}
