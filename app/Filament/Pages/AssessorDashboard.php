<?php

namespace App\Filament\Pages;

use App\Models\Assessor;
use Filament\Pages\Page;
use App\Models\Evaluation;
use Filament\Tables\Table;
use Filament\Tables\Actions\Action;
use Illuminate\Support\Facades\Auth;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use App\Filament\Resources\EvaluationResource;
use Filament\Tables\Concerns\InteractsWithTable;
use BezhanSalleh\FilamentShield\Traits\HasPageShield;

class AssessorDashboard extends Page implements HasTable
{
    use HasPageShield;
    use InteractsWithTable;
    protected static ?string $navigationIcon = 'heroicon-o-home';

    protected static string $view = 'filament.pages.assessor-dashboard';
    protected static ?string $navigationLabel = 'Halaman Utama';
    protected static ?string $navigationGroup='Home';

    public $assessor;

    public function mount(){
        $this->assessor=Assessor::where('user_id',Auth::user()->id)->first();
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(Evaluation::query()->where('assessor_id',$this->assessor->id)->with('participant'))
            ->columns([
                TextColumn::make('participant.name'),
                TextColumn::make('date')
                ->date(),
                TextColumn::make('total_Score')
                ->getStateUsing(function (Evaluation $record) {
                    // Hitung total score dari relasi examAnswers
                    return $record->evaluationDetails()->sum('score');
                }),
                IconColumn::make('Finish')
                ->boolean()
    ->getStateUsing(function (Evaluation $record) {
        $totalScore = $record->evaluationDetails()->sum('score');
        return $totalScore > 0; // True jika > 0, false jika 0/null
    })
    ->trueIcon('heroicon-o-check-circle') // Icon jika true
    ->falseIcon('heroicon-o-x-circle')    // Icon jika false
    ->trueColor('success')                // Warna hijau jika true
    ->falseColor('danger'),

            ])
            ->filters([
                // ...
            ])
            ->actions([
                Action::make('doEvaluation')
                ->label('Evaluate')
                ->url(fn($record): string => EvaluationResource::getUrl('do-evaluation', ['record' => $record->id]))
                // ->url(fn ($record): string => EvaluationResource::getUrl('do-evaluation', ['record' => $record]))
                ->icon('heroicon-s-document-text')
                ->color('primary'),
            ])
            ->bulkActions([
                // ...
            ]);
    }

}
