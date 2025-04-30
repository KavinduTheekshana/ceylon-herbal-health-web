<?php

namespace App\Filament\Resources\FaqResource\Pages;

use App\Filament\Resources\FaqCategoryResource;
use App\Filament\Resources\FaqResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditFaq extends EditRecord
{
    protected static string $resource = FaqResource::class;

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
        ];
    }
}
