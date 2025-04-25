<?php

namespace App\Filament\Resources\ExamResource\Pages;

use App\Models\Exam;
use Filament\Forms\Form;
use App\Models\Exam_Answer;
use Filament\Actions\Action;
use App\Models\Evaluation_details;
use Filament\Resources\Pages\Page;
use Filament\Actions\Concerns\HasForm;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use App\Filament\Resources\ExamResource;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Resources\Pages\Concerns\InteractsWithRecord;

class AssessorScoringEssay extends Page 
{
    
    use InteractsWithForms;
    
    protected static ?string $title = 'Scoring Essay';
    protected static string $resource = ExamResource::class;

    protected static string $view = 'filament.resources.exam-resource.pages.assessor-scoring-essay';

    public $record;
    public ?array $data = [];
    public function mount($record): void
    {
        $this->record = $record;
        $getDataExam=Exam::where('slug',$this->record)->with('answers.question')->first();
        $this->form->fill([
            'answers' => $getDataExam->answers()->with('question')->get()->toArray(),
        ]);
       
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Scoring Essay')
                    ->schema([
                        Repeater::make('answers')
                            ->label('Essay Result')
                            ->schema([
                                Textarea::make('question.question')
                                    ->label('Soal')
                                    ->disabled()
                                    ->columnSpan(1),
                                   
                                Textarea::make('question.essay_answer_key')
                                    ->label('Kunci Jawaban')
                                    ->disabled()
                                    ->columnSpan(1),
                                   
                                Textarea::make('essay_answer')
                                    ->label('Jawaban Peserta')
                                    ->disabled()
                                    ->columnSpan(1),
                                TextInput::make('score')
                                    ->label('Skor')
                                    ->numeric()
                                    ->required()
                            ])
                            ->columns(2)
                            ->disableItemCreation()
                            ->disableItemDeletion()
                    ])
            ]) ->statePath('data');
    }

protected function getHeaderActions(): array
{
    return [
        Action::make('save')
            ->label('Simpan Perubahan')
            ->action('save')
    ];
}

public function save(): void
{
   
    try {
        $data = $this->form->getState();
        
        // Update semua evaluation details
        foreach ($data['answers'] as $answer) {
            Exam_Answer::where('id', $answer['id'])->update([
                'score' => $answer['score'],
            ]);
        }
        

        Notification::make()
            ->title('Penilaian Tersimpan!')
            ->success()
            ->send();
            
    } catch (\Exception $e) {
        Notification::make()
            ->title('Gagal Menyimpan')
            ->danger()
            ->body($e->getMessage())
            ->send();
    }
}

       
}
