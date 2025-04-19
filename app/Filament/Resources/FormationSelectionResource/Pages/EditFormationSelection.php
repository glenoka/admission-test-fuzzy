<?php

namespace App\Filament\Resources\FormationSelectionResource\Pages;

use App\Filament\Resources\FormationSelectionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditFormationSelection extends EditRecord
{
    protected static string $resource = FormationSelectionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
