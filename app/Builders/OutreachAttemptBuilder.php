<?php

namespace App\Builders;

use App\Models\OutreachAttempt;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;

/**
 * @extends Builder<OutreachAttempt>
 */
class OutreachAttemptBuilder extends Builder
{
    public function sent(): self
    {
        return $this->whereNotNull('sent_at');
    }

    public function draft(): self
    {
        return $this->whereNull('sent_at');
    }

    public function awaitingResponse(): self
    {
        return $this->sent()->whereNull('outcome');
    }

    public function dueForFollowUp(int $days = 14): self
    {
        return $this
            ->awaitingResponse()
            ->where('sent_at', '<=', Carbon::now()->subDays($days))
            ->whereDoesntHave('followUps');
    }
}
