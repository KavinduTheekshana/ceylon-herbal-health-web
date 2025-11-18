<?php

namespace App\Filament\Widgets;

use App\Models\Appointment;
use App\Models\Service;
use App\Models\Therapist;
use App\Models\Contact;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\DB;

class StatsOverviewWidget extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        // Get current month stats
        $currentMonthAppointments = Appointment::whereMonth('preferred_date', now()->month)
            ->whereYear('preferred_date', now()->year)
            ->count();

        $lastMonthAppointments = Appointment::whereMonth('preferred_date', now()->subMonth()->month)
            ->whereYear('preferred_date', now()->subMonth()->month)
            ->count();

        $appointmentTrend = $lastMonthAppointments > 0
            ? round((($currentMonthAppointments - $lastMonthAppointments) / $lastMonthAppointments) * 100, 1)
            : 0;

        // Get today's appointments
        $todayAppointments = Appointment::whereDate('preferred_date', today())->count();

        // Upcoming appointments (next 7 days)
        $upcomingAppointments = Appointment::whereBetween('preferred_date', [
            now(),
            now()->addDays(7)
        ])->count();

        // Pending contacts
        $pendingContacts = Contact::where('status', 'pending')
            ->orWhereNull('status')
            ->count();

        // Confirmed appointments this month
        $confirmedThisMonth = Appointment::whereMonth('preferred_date', now()->month)
            ->whereYear('preferred_date', now()->year)
            ->where('status', 'confirmed')
            ->count();

        return [
            Stat::make('Total Appointments', Appointment::count())
                ->description('All time appointments')
                ->descriptionIcon('heroicon-m-calendar')
                ->color('success')
                ->chart([7, 3, 4, 5, 6, 3, 5, 3]),

            Stat::make('This Month', $currentMonthAppointments)
                ->description($appointmentTrend >= 0 ? "{$appointmentTrend}% increase" : "{$appointmentTrend}% decrease")
                ->descriptionIcon($appointmentTrend >= 0 ? 'heroicon-m-arrow-trending-up' : 'heroicon-m-arrow-trending-down')
                ->color($appointmentTrend >= 0 ? 'success' : 'danger')
                ->chart($this->getMonthlyChart()),

            Stat::make('Today\'s Appointments', $todayAppointments)
                ->description('Scheduled for today')
                ->descriptionIcon('heroicon-m-clock')
                ->color('info'),

            Stat::make('Upcoming (7 days)', $upcomingAppointments)
                ->description('Next week bookings')
                ->descriptionIcon('heroicon-m-calendar-days')
                ->color('warning'),

            Stat::make('Active Therapists', Therapist::where('is_active', true)->count())
                ->description('Available therapists')
                ->descriptionIcon('heroicon-m-user-group')
                ->color('success'),

            Stat::make('Pending Contacts', $pendingContacts)
                ->description('Requires attention')
                ->descriptionIcon('heroicon-m-envelope')
                ->color($pendingContacts > 0 ? 'danger' : 'success'),
        ];
    }

    protected function getMonthlyChart(): array
    {
        $data = [];
        for ($i = 29; $i >= 0; $i--) {
            $date = now()->subDays($i);
            $data[] = Appointment::whereDate('preferred_date', $date)->count();
        }
        return $data;
    }
}
