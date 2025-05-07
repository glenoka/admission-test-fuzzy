<?php

namespace App\Filament\Pages;

use App\Models\Ranking;
use Filament\Pages\Page;
use App\Models\FuzzyScore;
use App\Models\Participant;
use App\Models\Formation_Selection;
use Illuminate\Support\Facades\Auth;

class FormationRank extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.formation-rank';
    protected static ?string $title = 'Participant Page';

    public ?array $data=[];
    public ?array $participant=[];
    public ?array $rankData=[];
    public ?array $formation=[];


    public function mount(){
        $this->participant=Participant::where('user_id',Auth::user()->id)->first();

        $this->formation=Formation_Selection::where('participant_id',$this->participant->id)->first();
        $this->rankData=Ranking::where('formation_id',$this->formation->id)->get();
    }
}
