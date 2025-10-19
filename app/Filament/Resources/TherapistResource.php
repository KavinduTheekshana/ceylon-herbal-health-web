<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TherapistResource\Pages;
use App\Filament\Resources\TherapistResource\RelationManagers;
use App\Models\Therapist;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class TherapistResource extends Resource
{
    protected static ?string $model = Therapist::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $navigationGroup = 'Content Management';

    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Grid::make()
                    ->schema([
                        Forms\Components\Section::make('Therapist Information')
                            ->schema([
                                Forms\Components\TextInput::make('name')
                                    ->required()
                                    ->maxLength(255),

                                Forms\Components\TextInput::make('email')
                                    ->email()
                                    ->unique(ignoreRecord: true)
                                    ->maxLength(255),

                                Forms\Components\TextInput::make('phone')
                                    ->tel()
                                    ->maxLength(255),

                                Forms\Components\TextInput::make('specialization')
                                    ->maxLength(255)
                                    ->helperText('e.g., Ayurvedic Massage, Herbal Medicine, etc.'),

                                Forms\Components\Textarea::make('bio')
                                    ->rows(4)
                                    ->columnSpan('full'),

                                Forms\Components\FileUpload::make('image')
                                    ->image()
                                    ->directory('therapists')
                                    ->preserveFilenames()
                                    ->maxSize(2048)
                                    ->imageResizeMode('cover')
                                    ->imageCropAspectRatio('1:1')
                                    ->imageResizeTargetWidth('400')
                                    ->imageResizeTargetHeight('400')
                                    ->visibility('public')
                                    ->columnSpan('full'),

                                Forms\Components\Toggle::make('is_active')
                                    ->label('Active')
                                    ->default(true)
                                    ->helperText('When disabled, this therapist will not be available for assignment'),

                                Forms\Components\TextInput::make('order')
                                    ->numeric()
                                    ->default(0)
                                    ->helperText('Therapists are sorted by this value (ascending order)'),
                            ])
                            ->columns(2),

                        Forms\Components\Section::make('Holidays & Time Off')
                            ->description('Manage vacation days, sick leave, and other time off requests')
                            ->schema([
                                Forms\Components\Repeater::make('holidays')
                                    ->relationship('holidays')
                                    ->schema([
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
                                            ->afterOrEqual('start_date'),

                                        Forms\Components\TextInput::make('reason')
                                            ->label('Reason')
                                            ->placeholder('E.g., Vacation, Sick Leave, Personal Day')
                                            ->maxLength(255),

                                        Forms\Components\Select::make('status')
                                            ->label('Status')
                                            ->options([
                                                'pending' => 'Pending Approval',
                                                'approved' => 'Approved',
                                                'rejected' => 'Rejected',
                                            ])
                                            ->default('approved')
                                            ->required()
                                            ->native(false),

                                        Forms\Components\Textarea::make('notes')
                                            ->label('Additional Notes')
                                            ->rows(2)
                                            ->columnSpan('full')
                                            ->placeholder('Any additional information about this time off'),
                                    ])
                                    ->columns(4)
                                    ->defaultItems(0)
                                    ->addActionLabel('Add Holiday/Time Off')
                                    ->reorderable(false)
                                    ->collapsible()
                                    ->itemLabel(fn (array $state): ?string =>
                                        isset($state['start_date']) && isset($state['end_date'])
                                            ? ($state['start_date'] === $state['end_date']
                                                ? date('M d, Y', strtotime($state['start_date'])) .
                                                  (isset($state['reason']) ? ' - ' . $state['reason'] : '')
                                                : date('M d', strtotime($state['start_date'])) . ' to ' .
                                                  date('M d, Y', strtotime($state['end_date'])) .
                                                  (isset($state['reason']) ? ' - ' . $state['reason'] : ''))
                                            : 'New Holiday'
                                    )
                                    ->helperText('These dates will override the weekly schedule'),
                            ])
                            ->columnSpan(['lg' => 3])
                            ->collapsible(),

                        Forms\Components\Section::make('Weekly Availability Schedule')
                            ->description('Set recurring weekly schedule for this therapist')
                            ->schema([
                                Forms\Components\Repeater::make('availability')
                                    ->relationship('availability')
                                    ->schema([
                                        Forms\Components\Select::make('day_of_week')
                                            ->label('Day')
                                            ->required()
                                            ->options([
                                                'monday' => 'Monday',
                                                'tuesday' => 'Tuesday',
                                                'wednesday' => 'Wednesday',
                                                'thursday' => 'Thursday',
                                                'friday' => 'Friday',
                                                'saturday' => 'Saturday',
                                                'sunday' => 'Sunday',
                                            ])
                                            ->searchable()
                                            ->native(false),

                                        Forms\Components\TimePicker::make('start_time')
                                            ->label('Start Time')
                                            ->required()
                                            ->seconds(false)
                                            ->native(false)
                                            ->displayFormat('g:i A'),

                                        Forms\Components\TimePicker::make('end_time')
                                            ->label('End Time')
                                            ->required()
                                            ->seconds(false)
                                            ->native(false)
                                            ->displayFormat('g:i A')
                                            ->after('start_time'),

                                        Forms\Components\Toggle::make('is_available')
                                            ->label('Available')
                                            ->default(true)
                                            ->inline(false)
                                            ->helperText('Toggle off for days off'),

                                        Forms\Components\Textarea::make('notes')
                                            ->label('Notes')
                                            ->rows(2)
                                            ->columnSpan('full')
                                            ->placeholder('E.g., Lunch break 12-1 PM, Limited slots, etc.'),
                                    ])
                                    ->columns(4)
                                    ->defaultItems(0)
                                    ->addActionLabel('Add Day Schedule')
                                    ->reorderable(false)
                                    ->collapsible()
                                    ->collapsed(false)
                                    ->itemLabel(fn (array $state): ?string =>
                                        isset($state['day_of_week']) && isset($state['start_time'])
                                            ? ucfirst($state['day_of_week']) . ' - ' .
                                              date('g:i A', strtotime($state['start_time'])) . ' to ' .
                                              (isset($state['end_time']) ? date('g:i A', strtotime($state['end_time'])) : '...')
                                            : 'New Schedule'
                                    )
                                    ->cloneable()
                                    ->helperText('You can add multiple time slots per day (e.g., Morning 9-12, Afternoon 2-5)'),
                            ])
                            ->columnSpan(['lg' => 3])
                            ->collapsible(),
                    ])
                    ->columns(3),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')
                    ->circular()
                    ->defaultImageUrl(url('/images/default-avatar.png')),

                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('email')
                    ->searchable()
                    ->toggleable(),

                Tables\Columns\TextColumn::make('phone')
                    ->searchable()
                    ->toggleable(),

                Tables\Columns\TextColumn::make('specialization')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('services_count')
                    ->counts('services')
                    ->label('Services')
                    ->sortable(),

                Tables\Columns\IconColumn::make('is_active')
                    ->label('Status')
                    ->boolean()
                    ->sortable(),

                Tables\Columns\TextColumn::make('order')
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Status')
                    ->placeholder('All Therapists')
                    ->trueLabel('Active Therapists only')
                    ->falseLabel('Inactive Therapists only'),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('toggle_status')
                    ->label(fn(Therapist $record): string => $record->is_active ? 'Deactivate' : 'Activate')
                    ->icon(fn(Therapist $record): string => $record->is_active ? 'heroicon-o-x-circle' : 'heroicon-o-check-circle')
                    ->color(fn(Therapist $record): string => $record->is_active ? 'danger' : 'success')
                    ->action(fn(Therapist $record) => $record->update(['is_active' => !$record->is_active]))
                    ->requiresConfirmation(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\BulkAction::make('activate')
                        ->label('Activate Selected')
                        ->icon('heroicon-o-check-circle')
                        ->color('success')
                        ->action(fn(Builder $query) => $query->update(['is_active' => true]))
                        ->requiresConfirmation(),

                    Tables\Actions\BulkAction::make('deactivate')
                        ->label('Deactivate Selected')
                        ->icon('heroicon-o-x-circle')
                        ->color('danger')
                        ->action(fn(Builder $query) => $query->update(['is_active' => false]))
                        ->requiresConfirmation(),
                ]),
            ])
            ->reorderable('order')
            ->defaultSort('order');
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
            'index' => Pages\ListTherapists::route('/'),
            'create' => Pages\CreateTherapist::route('/create'),
            'edit' => Pages\EditTherapist::route('/{record}/edit'),
        ];
    }
}
