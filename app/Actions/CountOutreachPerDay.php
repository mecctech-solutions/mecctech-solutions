<?php

namespace App\Actions;

use App\Builders\OutreachAttemptBuilder;
use App\Data\DailyOutreachCountData;
use App\Models\OutreachAttempt;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Lorisleiva\Actions\Concerns\AsAction;
use RuntimeException;

class CountOutreachPerDay
{
    use AsAction;

    public const TIMEZONE = 'Europe/Amsterdam';

    public const DEFAULT_DAYS = 30;

    /**
     * Grouping happens in PHP against Amsterdam-local midnights because the
     * database stores sent_at in UTC, so an evening outreach would otherwise
     * land on the wrong calendar day.
     *
     * @return Collection<int, DailyOutreachCountData>
     */
    public function handle(int $days = self::DEFAULT_DAYS): Collection
    {
        $windowStart = Carbon::now(self::TIMEZONE)->startOfDay()->subDays($days - 1);
        $windowEnd = Carbon::now(self::TIMEZONE)->endOfDay();

        $countsByDate = OutreachAttempt::query()
            ->sent()
            ->whereBetween(OutreachAttemptBuilder::SENT_AT, [
                $windowStart->copy()->utc(),
                $windowEnd->copy()->utc(),
            ])
            ->get()
            ->groupBy(function (OutreachAttempt $attempt): string {
                $sentAt = $attempt->sent_at ?? throw new RuntimeException('A sent outreach attempt must have a sent_at timestamp.');

                return $sentAt->copy()->setTimezone(self::TIMEZONE)->toDateString();
            })
            ->map
            ->count();

        return Collection::make(range(0, $days - 1))
            ->map(function (int $offset) use ($windowStart, $countsByDate): DailyOutreachCountData {
                $date = $windowStart->copy()->addDays($offset);

                return new DailyOutreachCountData(
                    date: $date,
                    count: $countsByDate->get($date->toDateString(), 0),
                );
            });
    }
}
