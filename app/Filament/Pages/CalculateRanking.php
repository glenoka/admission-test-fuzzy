<?php

namespace App\Filament\Pages;

use App\Models\Criteria;
use Filament\Pages\Page;
use App\Models\FuzzyScore;
use Illuminate\Support\Facades\DB;

class CalculateRanking extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.calculate-ranking';
   
   
    public static function getNavigationLabel(): string
    {
        return 'Rank Calculation';
    }

    public function mount(): void
    {
       
        //max score per formation & criteria
       $scores = FuzzyScore::where('formation_id', 1)->get();
        $maxScores = FuzzyScore::where('formation_id', 1)
        ->select('criteria_id')
        ->selectRaw('MAX(score_fuzzy) as max_score')
        ->groupBy('criteria_id')
        ->pluck('max_score', 'criteria_id');
       

        // Perhitungan Matriks Ternormalisasi
       foreach ($scores as $score) {
        $maxScore = $maxScores[$score->criteria_id] ;
        
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

    }

       
    }
}
