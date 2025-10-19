<?php

namespace App\Filament\Resources\TherapistHolidayResource\Pages;

use App\Filament\Resources\TherapistHolidayResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTherapistHoliday extends EditRecord
{
    protected static string $resource = TherapistHolidayResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
