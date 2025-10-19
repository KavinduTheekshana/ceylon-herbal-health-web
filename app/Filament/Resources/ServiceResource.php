<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ServiceResource\Pages;
use App\Models\Service;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

class ServiceResource extends Resource
{
    protected static ?string $model = Service::class;

    protected static ?string $navigationIcon = 'heroicon-o-wrench-screwdriver';

    protected static ?string $navigationGroup = 'Content Management';

    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Grid::make()
                    ->schema([
                        Forms\Components\Section::make('Service Details')
                            ->schema([
                                Forms\Components\TextInput::make('title')
                                    ->required()
                                    ->maxLength(255)
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(fn(string $state, Forms\Set $set) =>
                                    $set('slug', Str::slug($state))),

                                Forms\Components\TextInput::make('slug')
                                    ->required()
                                    ->maxLength(255)
                                    ->unique(ignoreRecord: true)
                                    ->readOnly()
                                    ->extraAttributes([
                                        'style' => 'background-color: #f3f4f6;', // Light gray background
                                    ]),

                                Forms\Components\Textarea::make('short_description')
                                    ->nullable()
                                    ->maxLength(255)
                                    ->columnSpan('full'),

                                Forms\Components\RichEditor::make('description')
                                    ->required()
                                    ->columnSpan('full'),

                                Forms\Components\FileUpload::make('image')
                                    ->image()
                                    ->directory('services')
                                    ->preserveFilenames()
                                    ->maxSize(2048)
                                    ->imageResizeMode('cover')
                                    ->imageCropAspectRatio('16:9')
                                    ->imageResizeTargetWidth('1200')
                                    ->imageResizeTargetHeight('675')
                                    ->storeFiles(true) // Ensure files are actually stored
                                    ->visibility('public')
                                    ->columnSpan('full'),

                                Forms\Components\FileUpload::make('icon')
                                    ->label('SVG Icon')
                                    ->image()
                                    ->directory('icons')
                                    ->acceptedFileTypes(['image/svg+xml']) // Accept only SVG files
                                    ->maxSize(1024) // 1MB max
                                    ->helperText('Upload an SVG icon file')
                                    ->columnSpan('full'),

                                Forms\Components\Select::make('therapists')
                                    ->relationship('therapists', 'name')
                                    ->multiple()
                                    ->preload()
                                    ->searchable()
                                    ->helperText('Select therapists who can provide this service')
                                    ->columnSpan('full'),

                                Forms\Components\Group::make()
                                    ->schema([
                                        Forms\Components\Toggle::make('is_active')
                                            ->label('Active')
                                            ->default(true)
                                            ->helperText('When disabled, this service will not be displayed'),

                                        Forms\Components\Toggle::make('is_featured')
                                            ->label('Featured')
                                            ->default(false)
                                            ->helperText('Featured services may appear in highlighted sections'),

                                        Forms\Components\TextInput::make('order')
                                            ->numeric()
                                            ->default(0)
                                            ->helperText('Services are sorted by this value (ascending order)'),
                                    ])
                                    ->columns(1),
                            ])
                            ->columns(1)
                            ->columnSpan(['lg' => 2]),

                        Forms\Components\Section::make('SEO Metadata')
                            ->schema([
                                Forms\Components\TextInput::make('meta_title')
                                    ->nullable()
                                    ->maxLength(60)
                                    ->helperText('Max 60 characters recommended for SEO')
                                    ->columnSpan('full'),

                                Forms\Components\Textarea::make('meta_description')
                                    ->nullable()
                                    ->maxLength(160)
                                    ->helperText('Max 160 characters recommended for SEO')
                                    ->columnSpan('full'),

                                Forms\Components\TagsInput::make('meta_keywords')
                                    ->nullable()
                                    ->helperText('Comma-separated keywords for SEO')
                                    ->columnSpan('full'),
                            ])
                            ->columnSpan(['lg' => 1]),
                    ])
                    ->columns(3),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')
                    ->label('Image')
                    ->circular(false)
                    ->width(100)
                    ->height(60),

                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('short_description')
                    ->limit(30)
                    ->toggleable(),

                Tables\Columns\TextColumn::make('therapists.name')
                    ->label('Therapists')
                    ->badge()
                    ->separator(',')
                    ->toggleable(),

                Tables\Columns\IconColumn::make('is_active')
                    ->label('Status')
                    ->boolean()
                    ->sortable(),

                Tables\Columns\IconColumn::make('is_featured')
                    ->label('Featured')
                    ->boolean()
                    ->sortable(),

                Tables\Columns\TextColumn::make('order')
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Status')
                    ->placeholder('All Services')
                    ->trueLabel('Active Services only')
                    ->falseLabel('Inactive Services only'),

                Tables\Filters\TernaryFilter::make('is_featured')
                    ->label('Featured')
                    ->placeholder('All Services')
                    ->trueLabel('Featured Services only')
                    ->falseLabel('Non-Featured Services only'),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('toggle_status')
                    ->label(fn(Service $record): string => $record->is_active ? 'Disable' : 'Enable')
                    ->icon(fn(Service $record): string => $record->is_active ? 'heroicon-o-x-circle' : 'heroicon-o-check-circle')
                    ->color(fn(Service $record): string => $record->is_active ? 'danger' : 'success')
                    ->action(fn(Service $record) => $record->update(['is_active' => !$record->is_active]))
                    ->requiresConfirmation(),

                Tables\Actions\Action::make('toggle_featured')
                    ->label(fn(Service $record): string => $record->is_featured ? 'Unfeature' : 'Feature')
                    ->icon(fn(Service $record): string => $record->is_featured ? 'heroicon-o-minus-circle' : 'heroicon-o-star')
                    ->color(fn(Service $record): string => $record->is_featured ? 'warning' : 'primary')
                    ->action(fn(Service $record) => $record->update(['is_featured' => !$record->is_featured]))
                    ->requiresConfirmation(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\BulkAction::make('activate')
                        ->label('Enable Selected')
                        ->icon('heroicon-o-check-circle')
                        ->color('success')
                        ->action(fn(Builder $query) => $query->update(['is_active' => true]))
                        ->requiresConfirmation(),

                    Tables\Actions\BulkAction::make('deactivate')
                        ->label('Disable Selected')
                        ->icon('heroicon-o-x-circle')
                        ->color('danger')
                        ->action(fn(Builder $query) => $query->update(['is_active' => false]))
                        ->requiresConfirmation(),

                    Tables\Actions\BulkAction::make('feature')
                        ->label('Feature Selected')
                        ->icon('heroicon-o-star')
                        ->color('primary')
                        ->action(fn(Builder $query) => $query->update(['is_featured' => true]))
                        ->requiresConfirmation(),

                    Tables\Actions\BulkAction::make('unfeature')
                        ->label('Unfeature Selected')
                        ->icon('heroicon-o-minus-circle')
                        ->color('warning')
                        ->action(fn(Builder $query) => $query->update(['is_featured' => false]))
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
            'index' => Pages\ListServices::route('/'),
            'create' => Pages\CreateService::route('/create'),
            'view' => Pages\ViewService::route('/{record}'),
            'edit' => Pages\EditService::route('/{record}/edit'),
        ];
    }
}
