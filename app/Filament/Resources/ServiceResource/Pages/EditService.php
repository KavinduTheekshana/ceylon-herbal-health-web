<?php

namespace App\Filament\Resources\ServiceResource\Pages;

use App\Filament\Resources\ServiceResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditService extends EditRecord
{
    protected static string $resource = ServiceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
            Actions\Action::make('toggle_status')
                ->label(fn (): string => $this->record->is_active ? 'Disable' : 'Enable')
                ->icon(fn (): string => $this->record->is_active ? 'heroicon-o-x-circle' : 'heroicon-o-check-circle')
                ->color(fn (): string => $this->record->is_active ? 'danger' : 'success')
                ->action(fn () => $this->record->update(['is_active' => !$this->record->is_active]))
                ->requiresConfirmation(),

            Actions\Action::make('toggle_featured')
                ->label(fn (): string => $this->record->is_featured ? 'Unfeature' : 'Feature')
                ->icon(fn (): string => $this->record->is_featured ? 'heroicon-o-minus-circle' : 'heroicon-o-star')
                ->color(fn (): string => $this->record->is_featured ? 'warning' : 'primary')
                ->action(fn () => $this->record->update(['is_featured' => !$this->record->is_featured]))
                ->requiresConfirmation(),
        ];
    }
}
