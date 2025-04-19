<?php

namespace App\Filament\Resources\FormationSelectionResource\Pages;

use Filament\Forms\Form;
use Filament\Resources\Pages\Page;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use App\Filament\Resources\FormationSelectionResource;
use Filament\Resources\Pages\ViewRecord;


class DetailFormationSelection extends ViewRecord
{
    protected static string $resource = FormationSelectionResource::class;

    protected static string $view = 'filament.pages.detail-formation-selection';

 
    
public function form(Form $form): Form  {
    return $form
    ->schema([
        Section::make('Detail Participant')
    ->description('Informasi lengkap peserta')
    ->schema([
        TextInput::make('participant.name')
        ->label('Nama Peserta')
        ->disabled()
        ->dehydrated()
        ->default(fn () => $this->record->participant?->name)
        
    ])
    ]);
}

}
