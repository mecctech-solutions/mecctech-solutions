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
    public const SENT_AT = 'sent_at';

    public const OUTCOME = 'outcome';

    public const FOLLOW_UPS = 'followUps';

    public const DEFAULT_FOLLOW_UP_DAYS = 14;

    public function sent(): self
    {
        return $this->whereNotNull(self::SENT_AT);
    }

    public function draft(): self
    {
        return $this->whereNull(self::SENT_AT);
    }

    public function awaitingResponse(): self
    {
        return $this->sent()->whereNull(self::OUTCOME);
    }

    public function dueForFollowUp(int $days = self::DEFAULT_FOLLOW_UP_DAYS): self
    {
        return $this
            ->awaitingResponse()
            ->where(self::SENT_AT, '<=', Carbon::now()->subDays($days))
            ->whereDoesntHave(self::FOLLOW_UPS);
    }
}
