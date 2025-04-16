<?php

namespace App\Filament\Pages;

use App\Models\Exam;
use Filament\Pages\Page;
use Filament\Tables\Table;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Concerns\InteractsWithTable;

class EssayScoring extends Page implements HasTable
{
    use InteractsWithTable;
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.essay-scoring';

    public static function getNavigationLabel(): string
    {
        return 'Scoring Answer Essay';
    }

    public function Table(Table $table): Table
    {
        return $table
        ->query(
            Exam::query()
                ->with(['answers', 'package','participant'])
                ->whereNotNull('started_at')
                ->whereHas('package', function($query) {
                    $query->where('type_package', 'essay');
                })
        ) // Eager load relationships
            ->columns([
                
                TextColumn::make('participant.name')
                    ->label('Nama Peserta'),
                
                TextColumn::make('started_at')
                    ->label('Tanggal Ujian')
                    ->dateTime(),
            ])
            ->actions([
                Action::make('scoring')
                ->label('Check Answer')
                ->color('primary')
                ->icon('heroicon-o-check-circle')
                ->url(fn (Exam $record) => ExamAnswerEssayPage::getUrl([
                    'slug' => $record->slug,
                   
                ]))
                ->requiresConfirmation(),
                    ]);
            
                
           
    }

}
