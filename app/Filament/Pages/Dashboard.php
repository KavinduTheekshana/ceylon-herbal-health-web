<?php

namespace App\Filament\Pages;

use Filament\Pages\Dashboard as BaseDashboard;

class Dashboard extends BaseDashboard
{
    protected static ?string $navigationIcon = 'heroicon-o-home';
    protected static string $view = 'filament.pages.dashboard';

    public function getTitle(): string
    {
        return 'Ceylon Herbal Health - Dashboard';
    }

    public function getHeading(): string
    {
        $hour = now()->hour;
        $greeting = match(true) {
            $hour < 12 => 'Good Morning',
            $hour < 17 => 'Good Afternoon',
            default => 'Good Evening'
        };

        return $greeting . ', ' . auth()->user()->name . '!';
    }

    public function getSubheading(): ?string
    {
        return 'Welcome to your Ceylon Herbal Health management dashboard';
    }

    public function getColumns(): int | string | array
    {
        return [
            'default' => 1,
            'sm' => 1,
            'md' => 2,
            'lg' => 3,
            'xl' => 4,
            '2xl' => 4,
        ];
    }
}
