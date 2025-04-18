<?php

namespace App\Filament\Pages;

use App\Models\Exam;
use Filament\Pages\Page;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Concerns\InteractsWithTable;

class ExamResultsPage extends Page implements HasTable
{
    use InteractsWithTable;
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationGroup = 'Result';
    protected static string $view = 'filament.pages.exam-results-page';

    public static function getNavigationLabel(): string
    {
        return 'Multiple Choice Results';
    }
    public function table(Table $table): Table
    {
        return $table
            ->query(Exam::query()->with(['answers'])->whereNot('started_at',null)) // Eager load relationships
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
}
