<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TherapistHolidayResource\Pages;
use App\Filament\Resources\TherapistHolidayResource\RelationManagers;
use App\Models\TherapistHoliday;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class TherapistHolidayResource extends Resource
{
    protected static ?string $model = TherapistHoliday::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar-days';

    protected static ?string $navigationLabel = 'Holidays & Time Off';

    protected static ?string $modelLabel = 'Holiday';

    protected static ?string $pluralModelLabel = 'Holidays';

    protected static ?string $navigationGroup = 'Content Management';

    protected static ?int $navigationSort = 5;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Holiday Information')
                    ->schema([
                        Forms\Components\Select::make('therapist_id')
                            ->label('Therapist')
                            ->relationship('therapist', 'name', fn (Builder $query) => $query->where('is_active', true))
                            ->required()
                            ->searchable()
                            ->preload()
                            ->native(false)
                            ->helperText('Select the therapist requesting time off'),

                        Forms\Components\DatePicker::make('start_date')
                            ->label('Start Date')
                            ->required()
                            ->native(false)
                            ->displayFormat('M d, Y')
                            ->minDate(now())
                            ->live()
                            ->afterStateUpdated(function ($state, callable $set, callable $get) {
                                // Auto-set end date to start date if empty
                                if (!$get('end_date')) {
                                    $set('end_date', $state);
                                }
                            }),

                        Forms\Components\DatePicker::make('end_date')
                            ->label('End Date')
                            ->required()
                            ->native(false)
                            ->displayFormat('M d, Y')
                            ->minDate(now())
                            ->afterOrEqual('start_date')
                            ->helperText('For single day, use same date as start date'),

                        Forms\Components\TextInput::make('reason')
                            ->label('Reason')
                            ->maxLength(255)
                            ->placeholder('E.g., Vacation, Sick Leave, Personal Day, Conference')
                            ->helperText('Brief description of the time off'),

                        Forms\Components\Select::make('status')
                            ->label('Status')
                            ->options([
                                'pending' => 'Pending Approval',
                                'approved' => 'Approved',
                                'rejected' => 'Rejected',
                            ])
                            ->default('approved')
                            ->required()
                            ->native(false)
                            ->helperText('Approval status of this request'),

                        Forms\Components\Textarea::make('notes')
                            ->label('Additional Notes')
                            ->rows(3)
                            ->columnSpanFull()
                            ->placeholder('Any additional information or context about this time off request'),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('therapist.name')
                    ->label('Therapist')
                    ->searchable()
                    ->sortable()
                    ->weight('semibold'),

                Tables\Columns\TextColumn::make('start_date')
                    ->label('Start Date')
                    ->date('M d, Y')
                    ->sortable(),

                Tables\Columns\TextColumn::make('end_date')
                    ->label('End Date')
                    ->date('M d, Y')
                    ->sortable(),

                Tables\Columns\TextColumn::make('duration')
                    ->label('Duration')
                    ->state(function (TherapistHoliday $record): string {
                        $days = $record->duration;
                        return $days === 1 ? '1 day' : "$days days";
                    })
                    ->badge()
                    ->color('info'),

                Tables\Columns\TextColumn::make('reason')
                    ->label('Reason')
                    ->searchable()
                    ->limit(30)
                    ->tooltip(fn (TherapistHoliday $record): ?string => $record->reason),

                Tables\Columns\BadgeColumn::make('status')
                    ->label('Status')
                    ->colors([
                        'warning' => 'pending',
                        'success' => 'approved',
                        'danger' => 'rejected',
                    ])
                    ->icons([
                        'heroicon-o-clock' => 'pending',
                        'heroicon-o-check-circle' => 'approved',
                        'heroicon-o-x-circle' => 'rejected',
                    ])
                    ->formatStateUsing(fn (string $state): string => ucfirst($state)),

                Tables\Columns\TextColumn::make('notes')
                    ->label('Notes')
                    ->limit(40)
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Created')
                    ->dateTime('M d, Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('therapist')
                    ->relationship('therapist', 'name')
                    ->searchable()
                    ->preload()
                    ->label('Therapist'),

                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'approved' => 'Approved',
                        'rejected' => 'Rejected',
                    ])
                    ->label('Status'),

                Tables\Filters\Filter::make('upcoming')
                    ->label('Upcoming Holidays')
                    ->query(fn (Builder $query): Builder => $query->where('start_date', '>=', now())),

                Tables\Filters\Filter::make('active')
                    ->label('Currently Active')
                    ->query(fn (Builder $query): Builder =>
                        $query->where('start_date', '<=', now())
                              ->where('end_date', '>=', now())),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),

                Tables\Actions\Action::make('approve')
                    ->label('Approve')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->visible(fn (TherapistHoliday $record): bool => $record->status === 'pending')
                    ->action(fn (TherapistHoliday $record) => $record->update(['status' => 'approved']))
                    ->requiresConfirmation(),

                Tables\Actions\Action::make('reject')
                    ->label('Reject')
                    ->icon('heroicon-o-x-circle')
                    ->color('danger')
                    ->visible(fn (TherapistHoliday $record): bool => $record->status === 'pending')
                    ->action(fn (TherapistHoliday $record) => $record->update(['status' => 'rejected']))
                    ->requiresConfirmation(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),

                    Tables\Actions\BulkAction::make('approve')
                        ->label('Approve Selected')
                        ->icon('heroicon-o-check-circle')
                        ->color('success')
                        ->action(fn (Builder $query) => $query->update(['status' => 'approved']))
                        ->requiresConfirmation(),

                    Tables\Actions\BulkAction::make('reject')
                        ->label('Reject Selected')
                        ->icon('heroicon-o-x-circle')
                        ->color('danger')
                        ->action(fn (Builder $query) => $query->update(['status' => 'rejected']))
                        ->requiresConfirmation(),
                ]),
            ])
            ->defaultSort('start_date', 'desc');
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
            'index' => Pages\ListTherapistHolidays::route('/'),
            'create' => Pages\CreateTherapistHoliday::route('/create'),
            'edit' => Pages\EditTherapistHoliday::route('/{record}/edit'),
        ];
    }
}
