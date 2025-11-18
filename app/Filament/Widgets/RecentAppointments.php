<?php

namespace App\Filament\Widgets;

use App\Models\Appointment;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;

class RecentAppointments extends BaseWidget
{
    protected static ?int $sort = 3;
    protected int | string | array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->heading('Recent Appointments')
            ->query(
                Appointment::query()
                    ->latest('created_at')
                    ->limit(10)
            )
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable()
                    ->weight('medium')
                    ->icon('heroicon-m-user'),

                Tables\Columns\TextColumn::make('email')
                    ->searchable()
                    ->icon('heroicon-m-envelope')
                    ->color('gray'),

                Tables\Columns\TextColumn::make('phone')
                    ->searchable()
                    ->icon('heroicon-m-phone'),

                Tables\Columns\TextColumn::make('therapist.name')
                    ->searchable()
                    ->sortable()
                    ->badge()
                    ->color('info')
                    ->icon('heroicon-m-user-circle'),

                Tables\Columns\TextColumn::make('preferred_date')
                    ->date('M d, Y')
                    ->sortable()
                    ->icon('heroicon-m-calendar')
                    ->color('primary'),

                Tables\Columns\TextColumn::make('preferred_time')
                    ->badge()
                    ->icon('heroicon-m-clock')
                    ->color('warning'),

                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'confirmed' => 'success',
                        'pending' => 'warning',
                        'cancelled' => 'danger',
                        'completed' => 'info',
                        default => 'gray',
                    })
                    ->icon(fn (string $state): string => match ($state) {
                        'confirmed' => 'heroicon-m-check-circle',
                        'pending' => 'heroicon-m-clock',
                        'cancelled' => 'heroicon-m-x-circle',
                        'completed' => 'heroicon-m-check-badge',
                        default => 'heroicon-m-question-mark-circle',
                    }),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime('M d, H:i')
                    ->sortable()
                    ->toggleable()
                    ->color('gray')
                    ->size('sm'),
            ])
            ->defaultSort('created_at', 'desc')
            ->striped()
            ->actions([
                Tables\Actions\Action::make('view')
                    ->icon('heroicon-m-eye')
                    ->url(fn (Appointment $record): string => route('filament.admin.resources.appointments.view', $record))
                    ->color('info'),
            ]);
    }
}
