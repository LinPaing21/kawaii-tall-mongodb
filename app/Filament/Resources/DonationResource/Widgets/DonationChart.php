<?php

namespace App\Filament\Resources\DonationResource\Widgets;

use App\Models\Donation;
use Filament\Widgets\ChartWidget;

class DonationChart extends ChartWidget
{
    use \App\Traits\MonthlyChart;
    protected static ?string $heading = 'Donations';

    public ?string $filter = null;

    public function mount(): void
    {
        $this->filter = now()->year;
    }

    protected function getFilters(): ?array
    {
        return $this->filterYears(Donation::class);
    }

    protected function getData(): array
    {
        $data = $this->queryData(Donation::class);

        $data = $this->prepareData($data, $this->filter);

        return [
            'datasets' => [
                [
                    'label' => 'Total Donations per Month (in 2025)',
                    'data' => array_values($data),
                ],
            ],
            'labels' => array_keys($data),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
