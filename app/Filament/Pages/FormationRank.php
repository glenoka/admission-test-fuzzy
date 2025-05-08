<?php

namespace App\Filament\Pages;

use App\Models\Ranking;
use Filament\Pages\Page;
use App\Models\FuzzyScore;
use Filament\Tables\Table;
use App\Models\Participant;
use App\Models\Formation_Selection;
use Illuminate\Support\Facades\Auth;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Columns\Layout\Stack;
use Filament\Tables\Columns\Layout\Component;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Tables\Concerns\InteractsWithTable;
use BezhanSalleh\FilamentShield\Traits\HasPageShield;

class FormationRank extends Page implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;
    use HasPageShield;
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.formation-rank';
    protected static ?string $title = 'Formation Rank';

    public ?array $data=[];
    public $participant;
    public $rankData=[];
    public $formation;
    public $rank;
    public $user;


    public function mount(){
        $this->user = auth::user()->id;
        $this->participant=Participant::where('user_id',$this->user)->first();
    
        $this->formation=Formation_Selection::where('participant_id',$this->participant->id)->first();
        $this->rankData=Ranking::where('formation_id',$this->formation->formation_id)->with('participant','formation')->get();
        $this->rank=Ranking::where('participant_id',$this->participant->id)->first();
        
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(Ranking::where('formation_id',$this->formation->formation_id)->with('participant','formation'))
            ->columns([
                TextColumn::make('participant.name'),
                TextColumn::make('formation.name'),
                TextColumn::make('total_score'),
                TextColumn::make('rank')
            ])
            ->recordClasses(fn (Ranking $record) => match ($record->rank) {
                
                '2' => 'border-s-2 border-orange-600 dark:border-orange-300',
               
                default => null,
            })
            ->filters([
                // ...
            ])
            ->actions([
                // ...
            ])
            ->bulkActions([
                // ...
            ]);
    }
}
