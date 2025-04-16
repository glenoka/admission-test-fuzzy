<?php

namespace App\Filament\Pages;

use App\Models\Exam;
use Filament\Pages\Page;
use App\Models\Exam_Answer;
use Filament\Forms\Components\Section;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Tables\Concerns\InteractsWithTable;

class ExamAnswerEssayPage extends Page implements HasForms
{
    use InteractsWithForms;
    
    protected static ?string $navigationIcon = 'heroicon-o-document-check';
    protected static string $view = 'filament.pages.exam-answer-essay-page';
    
    
    public $examId;

    public function mount(): void
    {
        
        $this->examId = request()->query('slug');
        dd($this->examId);
        
        
        $this->form->fill(
            $this->answers->mapWithKeys(fn ($answer) => [
                "scores.{$answer->id}" => $answer->score ?? 0
            ])->toArray()
        );
    }
    protected function getFormSchema(): array
    {
        return [
            Section::make('Detail Peserta')
                ->schema([
                    TextInput::make('participant')
                        ->label('Nama Peserta')
                        ->disabled()
                        ->formatStateUsing(fn () => $this->exam->participant->name),
                        
                    TextInput::make('exam_date')
                        ->label('Tanggal Ujian')
                        ->disabled()
                        ->formatStateUsing(fn () => $this->exam->started_at->format('d F Y H:i')),
                ])
                ->columns(2),
                
            Section::make('Penilaian Jawaban')
                ->schema(
                    $this->answers->map(fn ($answer) => 
                        Section::make("Pertanyaan #{$answer->question->number}")
                            ->schema([
                                TextInput::make("question_{$answer->id}")
                                    ->label('Soal')
                                    ->disabled()
                                    ->columnSpanFull()
                                    ->formatStateUsing(fn () => $answer->question->text),
                                    
                                TextInput::make("correct_answer_{$answer->id}")
                                    ->label('Kunci Jawaban')
                                    ->disabled()
                                    ->formatStateUsing(fn () => $answer->question->correct_answer),
                                    
                                TextInput::make("participant_answer_{$answer->id}")
                                    ->label('Jawaban Peserta')
                                    ->disabled()
                                    ->formatStateUsing(fn () => $answer->answer),
                                    
                                TextInput::make("scores.{$answer->id}")
                                    ->label('Nilai')
                                    ->numeric()
                                    ->required()
                                    ->minValue(0)
                                    ->maxValue($answer->question->max_score ?? 10),
                            ])
                            ->columns(3)
                    )->toArray()
                ),
        ];
    }
    public function saveScores()
    {
        $scores = $this->form->getState()['scores'];
        
        foreach ($scores as $answerId => $score) {
            Exam_Answer::find($answerId)->update(['score' => $score]);
        }
        
        $this->notify('success', 'Nilai berhasil disimpan!');
        
        return redirect()->to(ExamResultsPage::getUrl());
    }
}
