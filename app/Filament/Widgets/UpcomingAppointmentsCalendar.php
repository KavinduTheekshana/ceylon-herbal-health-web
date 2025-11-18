<?php

namespace App\Filament\Widgets;

use App\Models\Appointment;
use Filament\Widgets\Widget;
use Illuminate\Support\Collection;

class UpcomingAppointmentsCalendar extends Widget
{
    protected static string $view = 'filament.widgets.upcoming-appointments-calendar';
    protected static ?int $sort = 5;
    protected int | string | array $columnSpan = 'full';

    public function getUpcomingAppointments(): Collection
    {
        return Appointment::with(['therapist', 'service'])
            ->whereBetween('preferred_date', [now(), now()->addDays(14)])
            ->orderBy('preferred_date')
            ->orderBy('preferred_time')
            ->limit(10)
            ->get()
            ->groupBy(function ($appointment) {
                return $appointment->preferred_date->format('Y-m-d');
            });
    }
}
