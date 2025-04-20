<?php

namespace App\Filament\Resources\EvaluationResource\Pages;

use App\Models\Aspect;
use Filament\Forms\Form;
use App\Models\Evaluation;
use App\Models\Evaluation_details;
use Filament\Resources\Pages\Page;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use App\Filament\Resources\EvaluationResource;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Resources\Pages\Concerns\InteractsWithRecord;

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
            Repeater::make('evaluationDetails')// Biarkan kosong karena sudah di-scoped ke record
                ->schema([
                    TextInput::make('aspect.task')
                    ->label('Aspect')
                        ->disabled(),
                    TextInput::make('score')
                        ->required()
                        ->numeric()
                        ->minValue(0)
                        ->maxValue(100)
                        ->label('Score')
                ])
                ->reorderable(false)
                ->addable(false)
                ->deletable(false)
        ])
        ->statePath('data');
}
}
