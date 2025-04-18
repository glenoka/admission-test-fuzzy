<?php

namespace App\Filament\Resources\EssayResultResource\Pages;

use App\Filament\Resources\EssayResultResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditEssayResult extends EditRecord
{
    protected static string $resource = EssayResultResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
