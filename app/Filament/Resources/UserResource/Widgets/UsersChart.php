<?php

namespace App\Filament\Resources\UserResource\Widgets;

use App\Models\User;
use Carbon\Carbon;
use Filament\Widgets\ChartWidget;

class UsersChart extends ChartWidget
{
    use \App\Traits\MonthlyChart;
    protected static ?string $heading = 'User Registrations';

    public ?string $filter = null;

    public function mount(): void
    {
        $this->filter = now()->year;
    }

    protected function getFilters(): ?array
    {
        return $this->filterYears(User::class);
    }
    protected function getData(): array
    {
        $data = $this->queryData(User::class);

        $data = $this->prepareData($data, $this->filter);

        return [
            'datasets' => [
                [
                    'label' => 'User Accounts created (in 2025)',
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
