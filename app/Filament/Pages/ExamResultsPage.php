<?php

namespace App\Filament\Pages;

use App\Models\Exam;
use App\Models\Participant;
use Filament\Pages\Page;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;
use Filament\Forms\Components\Builder;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Concerns\InteractsWithTable;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ExamResultsPage extends Page implements HasTable
{
    use InteractsWithTable;
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationGroup = 'Scoring & Result';
    protected static string $view = 'filament.pages.exam-results-page';

    public static function getNavigationLabel(): string
    {
        return 'Multiple Choice Results';
    }
    public function table(Table $table): Table
    {
        
       $participantId = Participant::where('user_id',(Auth::user()->id))->first();
      
       $role=Auth::user()->roles->first()->name;
       
       if($role=='participant'){
           $query= Exam::where('participant_id', $participantId->id)->with(['answers']);
          
         }else{
            $query= Exam::with(['answers'])->whereNot('started_at',null);
        }
        return $table
            ->query($query) // Eager load relationships
            ->columns([
                
                TextColumn::make('participant.name')
                    ->label('Nama Peserta'),
                
                TextColumn::make('started_at')
                    ->label('Tanggal Ujian')
                    ->dateTime(),
                
                TextColumn::make('total_score')
                    ->label('Total Skor')
                    ->getStateUsing(function (Exam $record) {
                        // Hitung total score dari relasi examAnswers
                        return $record->answers->sum('score');
                    })
                    ->numeric(2),
            ]);
    }

    public static function getEloquentQuery(): Builder
    {
        $query= parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
        $role=Auth::user()->roles->first()->name;
     
        if($role=="participant"){
            return $query->whereHas('participant', function ($query) {
                $query->where('user_id', Auth::user()->id);
            });
        }

        if($role=="assessor"){
            return $query->whereHas('assessor', function ($query) {
                $query->where('user_id', Auth::user()->id);
            });
           
        }
    
       
        return $query;
    }
}
