<?php

namespace App\Actions;

use App\Models\OutreachAttempt;
use Illuminate\Support\Carbon;
use Lorisleiva\Actions\Concerns\AsAction;

class MarkOutreachAttemptSent
{
    use AsAction;

    /**
     * Stamp an outreach attempt as sent.
     *
     * The operator copies the composed message and sends it from Outlook by
     * hand; this records that it happened so the tracking does not depend on
     * their memory. Defaults to the current time.
     */
    public function handle(OutreachAttempt $attempt, ?Carbon $sentAt = null): OutreachAttempt
    {
        $attempt->sent_at = $sentAt ?? Carbon::now();
        $attempt->save();

        return $attempt;
    }
}
