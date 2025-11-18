<?php

namespace App\Filament\Widgets;

use App\Models\Service;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class ServicesOverview extends BaseWidget
{
    protected static ?int $sort = 4;
    protected int | string | array $columnSpan = 'full';

    protected function getStats(): array
    {
        $services = Service::withCount('appointments')
            ->where('is_active', true)
            ->orderBy('appointments_count', 'desc')
            ->limit(4)
            ->get();

        // If we don't have 4 services, return a default stat
        if ($services->isEmpty()) {
            return [
                Stat::make('No Services', 0)
                    ->description('Create services to see statistics')
                    ->descriptionIcon('heroicon-m-information-circle')
                    ->color('gray'),
            ];
        }

        return $services->map(function ($service) {
            return Stat::make($service->title ?? 'Untitled Service', $service->appointments_count ?? 0)
                ->description('Total bookings')
                ->descriptionIcon('heroicon-m-calendar')
                ->color('success')
                ->extraAttributes([
                    'class' => 'cursor-pointer hover:scale-105 transition',
                ]);
        })->toArray();
    }

    protected function getColumns(): int
    {
        return 4;
    }
}
