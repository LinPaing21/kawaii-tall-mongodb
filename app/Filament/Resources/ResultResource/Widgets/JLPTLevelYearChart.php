<?php

namespace App\Filament\Resources\ResultResource\Widgets;

use Carbon\Carbon;
use App\Models\Result;
use Filament\Widgets\ChartWidget;

class JLPTLevelYearChart extends ChartWidget
{
    use \App\Traits\MonthlyChart;
    protected static ?string $heading = 'Exam Participations';

    public ?string $filter = null;

    public function mount(): void
    {
        $this->filter = now()->year;
    }

    protected function getFilters(): ?array
    {
        return $this->filterYears(Result::class);
    }

    protected function getData(): array
    {
        $data = $this->queryData(Result::class);

        $data = $this->prepareData($data, $this->filter);

        return [
            'datasets' => [
                [
                    'label' => 'Exam Participations per Level (in 2025)',
                    'data' => array_values($data),
                ],
            ],
            'labels' => array_keys($data),
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
