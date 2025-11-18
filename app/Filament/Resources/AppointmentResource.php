<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AppointmentResource\Pages;
use App\Models\Appointment;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class AppointmentResource extends Resource
{
    protected static ?string $model = Appointment::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar-days';

    protected static ?string $navigationLabel = 'Appointments';

    protected static ?string $modelLabel = 'Appointment';

    protected static ?int $navigationSort = 1;

    protected static ?string $navigationGroup = 'Appointments';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Patient Information')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(191)
                            ->label('Full Name'),
                        Forms\Components\TextInput::make('email')
                            ->email()
                            ->required()
                            ->maxLength(191)
                            ->label('Email Address'),
                        Forms\Components\TextInput::make('phone')
                            ->tel()
                            ->required()
                            ->maxLength(191)
                            ->label('Phone Number'),
                        Forms\Components\TextInput::make('age')
                            ->numeric()
                            ->minValue(1)
                            ->maxValue(120)
                            ->label('Age'),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Appointment Details')
                    ->schema([
                        Forms\Components\Select::make('service_id')
                            ->relationship('service', 'title')
                            ->required()
                            ->searchable()
                            ->preload()
                            ->label('Service'),
                        Forms\Components\Select::make('therapist_id')
                            ->relationship('therapist', 'name')
                            ->required()
                            ->searchable()
                            ->preload()
                            ->label('Therapist'),
                        Forms\Components\DatePicker::make('preferred_date')
                            ->required()
                            ->minDate(now())
                            ->label('Preferred Date'),
                        Forms\Components\TimePicker::make('preferred_time')
                            ->required()
                            ->label('Preferred Time'),
                        Forms\Components\Textarea::make('message')
                            ->label('Health Concerns / Message')
                            ->rows(3)
                            ->columnSpanFull(),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Status & Notes')
                    ->schema([
                        Forms\Components\Select::make('status')
                            ->options([
                                'pending' => 'Pending',
                                'confirmed' => 'Confirmed',
                                'cancelled' => 'Cancelled',
                                'completed' => 'Completed',
                            ])
                            ->required()
                            ->default('pending')
                            ->label('Status'),
                        Forms\Components\DateTimePicker::make('confirmed_at')
                            ->label('Confirmed At')
                            ->visible(fn ($get) => $get('status') === 'confirmed'),
                        Forms\Components\Textarea::make('admin_notes')
                            ->label('Admin Notes (Internal)')
                            ->rows(3)
                            ->columnSpanFull(),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable()
                    ->label('Patient Name'),
                Tables\Columns\TextColumn::make('email')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('phone')
                    ->searchable()
                    ->label('Phone'),
                Tables\Columns\TextColumn::make('service.title')
                    ->searchable()
                    ->sortable()
                    ->label('Service')
                    ->limit(30),
                Tables\Columns\TextColumn::make('therapist.name')
                    ->searchable()
                    ->sortable()
                    ->label('Therapist'),
                Tables\Columns\TextColumn::make('preferred_date')
                    ->date()
                    ->sortable()
                    ->label('Date'),
                Tables\Columns\TextColumn::make('preferred_time')
                    ->label('Time'),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'pending' => 'warning',
                        'confirmed' => 'success',
                        'cancelled' => 'danger',
                        'completed' => 'info',
                        default => 'gray',
                    })
                    ->sortable(),
                Tables\Columns\TextColumn::make('confirmed_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->label('Submitted At'),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('preferred_date', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'confirmed' => 'Confirmed',
                        'cancelled' => 'Cancelled',
                        'completed' => 'Completed',
                    ])
                    ->multiple(),
                Tables\Filters\SelectFilter::make('service')
                    ->relationship('service', 'title')
                    ->searchable()
                    ->preload()
                    ->multiple(),
                Tables\Filters\SelectFilter::make('therapist')
                    ->relationship('therapist', 'name')
                    ->searchable()
                    ->preload()
                    ->multiple(),
                Tables\Filters\Filter::make('preferred_date')
                    ->form([
                        Forms\Components\DatePicker::make('date_from')
                            ->label('Date From'),
                        Forms\Components\DatePicker::make('date_until')
                            ->label('Date Until'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['date_from'],
                                fn (Builder $query, $date): Builder => $query->whereDate('preferred_date', '>=', $date),
                            )
                            ->when(
                                $data['date_until'],
                                fn (Builder $query, $date): Builder => $query->whereDate('preferred_date', '<=', $date),
                            );
                    })
                    ->indicateUsing(function (array $data): array {
                        $indicators = [];
                        if ($data['date_from'] ?? null) {
                            $indicators[] = 'From ' . \Carbon\Carbon::parse($data['date_from'])->toFormattedDateString();
                        }
                        if ($data['date_until'] ?? null) {
                            $indicators[] = 'Until ' . \Carbon\Carbon::parse($data['date_until'])->toFormattedDateString();
                        }
                        return $indicators;
                    }),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),
                Tables\Actions\Action::make('confirm')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->requiresConfirmation()
                    ->action(function (Appointment $record) {
                        $record->update([
                            'status' => 'confirmed',
                            'confirmed_at' => now(),
                        ]);
                    })
                    ->visible(fn (Appointment $record) => $record->status === 'pending'),
                Tables\Actions\Action::make('cancel')
                    ->icon('heroicon-o-x-circle')
                    ->color('danger')
                    ->requiresConfirmation()
                    ->action(function (Appointment $record) {
                        $record->update(['status' => 'cancelled']);
                    })
                    ->visible(fn (Appointment $record) => in_array($record->status, ['pending', 'confirmed'])),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\BulkAction::make('confirm')
                        ->label('Confirm Selected')
                        ->icon('heroicon-o-check-circle')
                        ->color('success')
                        ->requiresConfirmation()
                        ->action(function (\Illuminate\Database\Eloquent\Collection $records) {
                            $records->each->update([
                                'status' => 'confirmed',
                                'confirmed_at' => now(),
                            ]);
                        }),
                    Tables\Actions\BulkAction::make('cancel')
                        ->label('Cancel Selected')
                        ->icon('heroicon-o-x-circle')
                        ->color('danger')
                        ->requiresConfirmation()
                        ->action(function (\Illuminate\Database\Eloquent\Collection $records) {
                            $records->each->update(['status' => 'cancelled']);
                        }),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAppointments::route('/'),
            'create' => Pages\CreateAppointment::route('/create'),
            'edit' => Pages\EditAppointment::route('/{record}/edit'),
            'view' => Pages\ViewAppointment::route('/{record}'),
        ];
    }
}
