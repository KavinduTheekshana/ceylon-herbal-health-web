<?php

namespace App\Filament\Widgets;

use App\Models\Appointment;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class AppointmentsChart extends ChartWidget
{
    protected static ?string $heading = 'Appointments Overview';
    protected static ?int $sort = 2;
    protected static ?string $maxHeight = '300px';

    public ?string $filter = 'month';

    protected function getData(): array
    {
        $data = $this->getAppointmentsData();

        return [
            'datasets' => [
                [
                    'label' => 'Appointments',
                    'data' => $data['counts'],
                    'backgroundColor' => 'rgba(59, 130, 246, 0.1)',
                    'borderColor' => 'rgb(59, 130, 246)',
                    'pointBackgroundColor' => 'rgb(59, 130, 246)',
                    'pointBorderColor' => '#fff',
                    'pointHoverBackgroundColor' => '#fff',
                    'pointHoverBorderColor' => 'rgb(59, 130, 246)',
                    'fill' => true,
                    'tension' => 0.4,
                ],
            ],
            'labels' => $data['labels'],
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }

    protected function getFilters(): ?array
    {
        return [
            'week' => 'Last Week',
            'month' => 'Last Month',
            'year' => 'This Year',
        ];
    }

    protected function getAppointmentsData(): array
    {
        $filter = $this->filter;

        return match ($filter) {
            'week' => $this->getWeekData(),
            'year' => $this->getYearData(),
            default => $this->getMonthData(),
        };
    }

    protected function getWeekData(): array
    {
        $labels = [];
        $counts = [];

        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i);
            $labels[] = $date->format('D');
            $counts[] = Appointment::whereDate('preferred_date', $date)->count();
        }

        return ['labels' => $labels, 'counts' => $counts];
    }

    protected function getMonthData(): array
    {
        $labels = [];
        $counts = [];
        $daysInMonth = now()->daysInMonth;

        for ($day = 1; $day <= $daysInMonth; $day++) {
            $date = now()->startOfMonth()->addDays($day - 1);
            $labels[] = $date->format('M d');
            $counts[] = Appointment::whereDate('preferred_date', $date)->count();
        }

        return ['labels' => $labels, 'counts' => $counts];
    }

    protected function getYearData(): array
    {
        $labels = [];
        $counts = [];

        for ($month = 1; $month <= 12; $month++) {
            $date = now()->startOfYear()->addMonths($month - 1);
            $labels[] = $date->format('M');
            $counts[] = Appointment::whereMonth('preferred_date', $month)
                ->whereYear('preferred_date', now()->year)
                ->count();
        }

        return ['labels' => $labels, 'counts' => $counts];
    }
}
