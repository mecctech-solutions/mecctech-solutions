<?php

namespace App\Actions;

use App\Models\OutreachAttempt;
use Illuminate\Support\Carbon;
use Lorisleiva\Actions\Concerns\AsAction;

class MarkOutreachAttemptSent
{
    use AsAction;

    /**
     * The message itself is sent by hand from Outlook, so tracking would
     * otherwise depend on the operator's memory.
     */
    public function handle(OutreachAttempt $attempt, ?Carbon $sentAt = null): OutreachAttempt
    {
        $attempt->sent_at = $sentAt ?? Carbon::now();
        $attempt->save();

        return $attempt;
    }
}
