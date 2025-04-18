<?php

namespace App\Filament\Resources\EssayResultResource\Pages;

use App\Filament\Resources\EssayResultResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListEssayResults extends ListRecords
{
    protected static string $resource = EssayResultResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
