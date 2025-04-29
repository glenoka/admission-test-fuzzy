<?php

namespace App\Filament\Pages;

use App\Models\Criteria;
use Filament\Pages\Page;
use App\Models\Formation;
use App\Models\FuzzyScore;
use Filament\Tables\Table;
use Illuminate\Support\Facades\DB;
use App\Models\Formation_Selection;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Concerns\InteractsWithTable;

class CalculateRanking extends Page implements HasTable

{
    use InteractsWithTable;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.calculate-ranking';


    public static function getNavigationLabel(): string
    {
        return 'Rank Calculation';
    }
//   public function mount(): void
//     {
//         $this->calculateRanking(1);
//     }
    public function table(Table $table): Table
    {
        return $table
            ->query(Formation_Selection::query()
                ->with(['participant','formation','ranking'])
                ->where('status','accepted')
                
            )
            ->columns([
                TextColumn::make('participant.name')
                    ->label('Nama Peserta'),
                TextColumn::make('formation.name')
                    ->label('Formasi'),
                    TextColumn::make('ranking.total_score')
                    ->placeholder('N/A')
                    ->default('N/A'),
                
                TextColumn::make('ranking.rank')
                    ->label('Rank')
                    ->placeholder('N/A')
                    ->default('N/A'),
            ])
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
    
    public function calculateRanking(String $formationId): void
    {
        //reset the fuzzy_scores table
        $fuzzyScores=DB::table('fuzzy_scores')
            ->where('formation_id', $formationId)
            ->update([
                'score_final' => null,                
                'score_fuzzy_normalized' => null,
            ]);

        //max score per formation & criteria
        $scores = FuzzyScore::where('formation_id', $formationId)->get();
        $maxScores = FuzzyScore::where('formation_id', 1)
            ->select('criteria_id')
            ->selectRaw('MAX(score_fuzzy) as max_score')
            ->groupBy('criteria_id')
            ->pluck('max_score', 'criteria_id');


        // Perhitungan Matriks Ternormalisasi
        foreach ($scores as $score) {
            $maxScore = $maxScores[$score->criteria_id];

            $normalizedValue = $maxScore > 0 ? $score->score_fuzzy / $maxScore : 0;

            $score->update([
                'score_fuzzy_normalized' => $normalizedValue
            ]);

            //Bobot dan Perankingan
            $invalidCriteria = Criteria::whereNull('value')->count();


            // Eksekusi perhitungan langsung di database
            DB::table('fuzzy_scores as fs')
                ->join('criterias as c', 'fs.criteria_id', '=', 'c.id')
                ->update([
                    'fs.score_final' => DB::raw('fs.score_fuzzy_normalized * c.value')
                ]);


            //simpan di tabel rank  
            $rankings = FuzzyScore::where('formation_id', 1)
                ->select('participant_id', DB::raw('SUM(score_final) as total_score'))
                ->groupBy('participant_id')
                ->orderByDesc('total_score')
                ->get();
            $rank = 1;
            foreach ($rankings as $ranking) {
                DB::table('rankings')->updateOrInsert(
                    [
                        'participant_id' => $ranking->participant_id,
                        'formation_id' => 1,
                    ],
                    [
                        'total_score' => $ranking->total_score,
                        'rank' => $rank++,
                    ]
                );
            }
            // Update the rank in the rankings table

        }
    }
}
