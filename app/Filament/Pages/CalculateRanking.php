<?php

namespace App\Filament\Pages;

use App\Models\FuzzyScore;
use Filament\Pages\Page;

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
       //get data score_fuzzy

       $scores = FuzzyScore::where('formation_id', 1)->get();
        // Kelompokkan berdasarkan formation_id dan cari max_score_fuzzy per kelompok
        $maxScores = FuzzyScore::where('formation_id', 1)
        ->select('criteria_id')
        ->selectRaw('MAX(score_fuzzy) as max_score')
        ->groupBy('criteria_id')
        ->pluck('max_score', 'criteria_id');
       


       foreach ($scores as $score) {
        $maxScore = $maxScores[$score->criteria_id] ;
        
        $normalizedValue = $maxScore > 0 ? $score->score_fuzzy / $maxScore : 0;
        
        $score->update([
            'score_fuzzy_normalized' => $normalizedValue
        ]);
    
    }

       
    }
}
