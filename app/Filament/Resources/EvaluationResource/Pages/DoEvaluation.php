<?php

namespace App\Filament\Resources\EvaluationResource\Pages;

use App\Models\Aspect;
use Filament\Forms\Form;
use App\Models\Evaluation;
use Filament\Actions\Action;
use App\Models\Evaluation_details;
use Filament\Resources\Pages\Page;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use App\Filament\Resources\EvaluationResource;
use App\Models\Formation_Selection;
use App\Models\FuzzyScore;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Resources\Pages\Concerns\InteractsWithRecord;
use FuzzyScoreConvert;

class DoEvaluation extends Page
{
    use InteractsWithRecord;
    use InteractsWithForms;
    protected static string $resource = EvaluationResource::class;
    protected static string $view = 'filament.resources.evaluation-resource.pages.do-evaluation';
    public $aspect;
    public ?array $data = [];
    public function mount($record): void
{
    $this->record = Evaluation::find($record); // Pastikan model di-resolve dengan ID
    
    
    if (!$this->record) {
        abort(404, 'Evaluasi tidak ditemukan');
    }

    $this->aspect = Aspect::all();
    
    // Cek apakah sudah ada evaluation details
    if (!$this->record->evaluationDetails()->exists()) {
        $aspects = Aspect::all();
        foreach ($aspects as $aspect) {
            $this->record->evaluationDetails()->create([
                'aspect_id' => $aspect->id,
                'score' => 0
            ]);
        }
    }

    $this->form->fill([
        'evaluationDetails' => $this->record->evaluationDetails()->with('aspect.section')->get()->toArray()
    ]);
  


}
    

public function form(Form $form): Form
{

    return $form 
    ->schema([
        Repeater::make('evaluationDetails')
            ->label('Penilaian Aspek')
            ->schema([
                Section::make()
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextInput::make('aspect.task')
                                    ->label('Aspek Penilaian')
                                    ->disabled()
                                    ->prefixIcon('heroicon-o-clipboard-document-list')
                                    ->columnSpanFull()
                                    ->extraAttributes(['class' => 'font-bold text-primary-600']),
                                    
                                TextInput::make('score')
                                    ->label('Skor')
                                    ->numeric()
                                    ->minValue(0)
                                    ->maxValue(10)
                                    ->required()
                                    ->prefixIcon('heroicon-o-star')
                                    ->hint('Skala 0-10')
                                    ->suffixIcon('heroicon-m-scale')
                                    ->extraAttributes(['class' => 'bg-gray-50 rounded-lg'])
                            ])
                    ])
                    ->heading(fn ($state) => "Aspek #" . ($state['aspect']['task'] ?? ''))
                    ->collapsible()
            ])
            ->itemLabel(fn (array $state): ?string => $state['aspect']['section']['name'] ?? null)
            ->addable(false)
            ->deletable(false)
            ->reorderable(false)
            ->grid(1)
            ->columns(1)
            ->extraAttributes(['class' => 'space-y-4'])
    ])
    ->statePath('data');
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
        $score_total=0;
        // Update semua evaluation details
        foreach ($data['evaluationDetails'] as $detail) {
            $score_total += $detail['score'];
            Evaluation_details::updateOrCreate(
                [
                    'evaluation_id' => $this->record->id,
                    'aspect_id' => $detail['aspect']['id']
                ],
                ['score' => $detail['score']]
            );
        }
        $converter = new FuzzyScoreConvert();
        $conversion = $converter->convertToFuzzyValue($score_total);
       
        $getFormation=Formation_Selection::where('participant_id',$this->record->participant_id)->first();
        FuzzyScore::updateOrCreate([
            'source_type' => 2, // 1=exam, 2=evaluation
            'source_id' => $this->record->id,
            'participant_id' => $this->record->participant_id,
            'criteria_id' => 2, // ID dari criteria
        ],[
            'score' => $score_total,
            'formation_id' => $getFormation->formation_id,
            'score_fuzzy' => $conversion,
        ]);

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
