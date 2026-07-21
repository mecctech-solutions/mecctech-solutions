<?php

namespace App\Filament\Widgets;

use App\Actions\CountOutreachPerDay;
use App\Data\DailyOutreachCountData;
use Filament\Widgets\ChartWidget;

class OutreachPerDayChart extends ChartWidget
{
    protected const BRAND_COLOR = '#e30613';

    protected const LABEL_DATE_FORMAT = 'd M';

    protected static ?string $heading = 'Outreach per dag';

    protected static ?string $description = 'Verstuurde outreach over de laatste 30 dagen';

    protected int|string|array $columnSpan = 'full';

    /**
     * @return array{datasets: array<int, array<string, mixed>>, labels: array<int, string>}
     */
    protected function getData(): array
    {
        $daily = CountOutreachPerDay::run();

        return [
            'datasets' => [
                [
                    'label' => 'Verstuurd',
                    'data' => $daily->pluck('count')->all(),
                    'backgroundColor' => self::BRAND_COLOR,
                ],
            ],
            'labels' => $daily
                ->map(fn (DailyOutreachCountData $day): string => $day->date->translatedFormat(self::LABEL_DATE_FORMAT))
                ->all(),
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
