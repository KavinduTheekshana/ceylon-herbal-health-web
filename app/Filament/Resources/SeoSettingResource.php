<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SeoSettingResource\Pages;
use App\Models\SeoSetting;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class SeoSettingResource extends Resource
{
    protected static ?string $model = SeoSetting::class;

    protected static ?string $navigationIcon = 'heroicon-o-magnifying-glass';

    protected static ?string $navigationLabel = 'SEO Settings';

    protected static ?string $modelLabel = 'SEO Setting';

    protected static ?string $navigationGroup = 'Settings';

    protected static ?int $navigationSort = 10;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Page Information')
                    ->schema([
                        Forms\Components\TextInput::make('key')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(191)
                            ->label('Page Key')
                            ->helperText('e.g., "default", "home", "services", "about", "contact"')
                            ->placeholder('home'),

                        Forms\Components\TextInput::make('page_name')
                            ->maxLength(191)
                            ->label('Page Display Name')
                            ->helperText('Friendly name for identification')
                            ->placeholder('Homepage'),

                        Forms\Components\Toggle::make('is_active')
                            ->label('Active')
                            ->default(true)
                            ->helperText('Enable/disable this SEO configuration'),
                    ])
                    ->columns(3),

                Forms\Components\Section::make('Basic SEO')
                    ->description('Essential SEO information for search engines')
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->maxLength(255)
                            ->label('Page Title')
                            ->helperText('50-60 characters recommended')
                            ->placeholder('Ceylon Herbal Health - Authentic Ceylon Ayurveda')
                            ->columnSpanFull(),

                        Forms\Components\Textarea::make('meta_description')
                            ->rows(3)
                            ->maxLength(500)
                            ->label('Meta Description')
                            ->helperText('150-160 characters recommended')
                            ->placeholder('Experience authentic Ceylon Ayurveda healing and wellness treatments...')
                            ->columnSpanFull(),

                        Forms\Components\Textarea::make('meta_keywords')
                            ->rows(2)
                            ->label('Meta Keywords')
                            ->helperText('Comma-separated keywords')
                            ->placeholder('Ayurveda UK, Ceylon Ayurveda, Natural Healing, Wellness')
                            ->columnSpanFull(),

                        Forms\Components\Select::make('robots')
                            ->options([
                                'index, follow' => 'Index, Follow (Recommended)',
                                'noindex, follow' => 'No Index, Follow',
                                'index, nofollow' => 'Index, No Follow',
                                'noindex, nofollow' => 'No Index, No Follow',
                            ])
                            ->default('index, follow')
                            ->label('Robots Meta Tag')
                            ->helperText('Controls how search engines index this page'),

                        Forms\Components\TextInput::make('canonical_url')
                            ->url()
                            ->maxLength(500)
                            ->label('Canonical URL')
                            ->helperText('Leave empty to use current page URL')
                            ->placeholder('https://ceylonherbalhealth.co.uk/page'),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Open Graph (Facebook, LinkedIn)')
                    ->description('Optimize how your pages appear when shared on social media')
                    ->schema([
                        Forms\Components\TextInput::make('og_title')
                            ->maxLength(255)
                            ->label('OG Title')
                            ->helperText('Leave empty to use Page Title')
                            ->placeholder('Ceylon Herbal Health - Authentic Ayurveda'),

                        Forms\Components\Select::make('og_type')
                            ->options([
                                'website' => 'Website',
                                'article' => 'Article',
                                'product' => 'Product',
                                'profile' => 'Profile',
                            ])
                            ->default('website')
                            ->label('OG Type'),

                        Forms\Components\Textarea::make('og_description')
                            ->rows(2)
                            ->maxLength(500)
                            ->label('OG Description')
                            ->helperText('Leave empty to use Meta Description')
                            ->placeholder('Experience authentic Ceylon Ayurveda...')
                            ->columnSpanFull(),

                        Forms\Components\FileUpload::make('og_image')
                            ->image()
                            ->directory('seo/og-images')
                            ->label('OG Image')
                            ->helperText('Recommended: 1200x630px')
                            ->imageEditor()
                            ->imageEditorAspectRatios([
                                '1.91:1',
                            ])
                            ->columnSpanFull(),
                    ])
                    ->columns(2)
                    ->collapsible(),

                Forms\Components\Section::make('Twitter Card')
                    ->description('Optimize how your pages appear on Twitter')
                    ->schema([
                        Forms\Components\TextInput::make('twitter_title')
                            ->maxLength(255)
                            ->label('Twitter Title')
                            ->helperText('Leave empty to use OG Title or Page Title')
                            ->placeholder('Ceylon Herbal Health'),

                        Forms\Components\Textarea::make('twitter_description')
                            ->rows(2)
                            ->maxLength(500)
                            ->label('Twitter Description')
                            ->helperText('Leave empty to use OG Description or Meta Description')
                            ->columnSpanFull(),

                        Forms\Components\FileUpload::make('twitter_image')
                            ->image()
                            ->directory('seo/twitter-images')
                            ->label('Twitter Image')
                            ->helperText('Recommended: 1200x628px (Leave empty to use OG Image)')
                            ->imageEditor()
                            ->imageEditorAspectRatios([
                                '2:1',
                            ])
                            ->columnSpanFull(),
                    ])
                    ->columns(1)
                    ->collapsible(),

                Forms\Components\Section::make('Website Icons')
                    ->description('Upload custom favicon and app icons for this page (optional)')
                    ->schema([
                        Forms\Components\FileUpload::make('favicon')
                            ->image()
                            ->directory('seo/favicons')
                            ->label('Favicon')
                            ->helperText('ICO or PNG format, 32x32px or larger')
                            ->acceptedFileTypes(['image/x-icon', 'image/png', 'image/svg+xml']),

                        Forms\Components\FileUpload::make('apple_touch_icon')
                            ->image()
                            ->directory('seo/icons')
                            ->label('Apple Touch Icon')
                            ->helperText('PNG format, 180x180px recommended'),
                    ])
                    ->columns(2)
                    ->collapsible()
                    ->collapsed(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('page_name')
                    ->label('Page')
                    ->searchable()
                    ->sortable()
                    ->description(fn (SeoSetting $record): string => $record->key),

                Tables\Columns\TextColumn::make('title')
                    ->label('SEO Title')
                    ->limit(50)
                    ->searchable()
                    ->sortable()
                    ->tooltip(fn (SeoSetting $record): string => $record->title ?? 'No title set'),

                Tables\Columns\TextColumn::make('meta_description')
                    ->label('Description')
                    ->limit(60)
                    ->searchable()
                    ->toggleable()
                    ->tooltip(fn (SeoSetting $record): string => $record->meta_description ?? 'No description set'),

                Tables\Columns\IconColumn::make('is_active')
                    ->label('Active')
                    ->boolean()
                    ->sortable(),

                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Last Updated')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Active Status')
                    ->placeholder('All settings')
                    ->trueLabel('Active only')
                    ->falseLabel('Inactive only'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('preview')
                    ->icon('heroicon-o-eye')
                    ->url(fn (SeoSetting $record): string => '/?seo_preview=' . $record->key)
                    ->openUrlInNewTab(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('key', 'asc');
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
            'index' => Pages\ListSeoSettings::route('/'),
            'create' => Pages\CreateSeoSetting::route('/create'),
            'edit' => Pages\EditSeoSetting::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::where('is_active', true)->count();
    }
}
