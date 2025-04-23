<?php

namespace App\Filament\Resources\AssessorEvaluateResource\Pages;

use App\Filament\Resources\AssessorEvaluateResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAssessorEvaluates extends ListRecords
{
    protected static string $resource = AssessorEvaluateResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
