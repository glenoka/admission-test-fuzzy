<?php

namespace App\Filament\Resources\EvaluationResource\Pages;

use Filament\Resources\Pages\Page;
use App\Filament\Resources\EvaluationResource;
use Filament\Resources\Pages\Concerns\InteractsWithRecord;

class DoEvaluation extends Page
{
    use InteractsWithRecord;
    protected static string $resource = EvaluationResource::class;
    protected static string $view = 'filament.resources.evaluation-resource.pages.do-evaluation';

    public function mount($record): void
    {
        $this->record = $this->resolveRecord($record);
        dd($this->record);
    }
}
