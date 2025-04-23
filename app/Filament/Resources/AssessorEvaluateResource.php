<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use App\Models\Formation;
use App\Models\Evaluation;
use Filament\Tables\Table;
use Filament\Tables\Actions\Action;
use App\Models\AssessorEvaluate;
use Filament\Resources\Resource;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\AssessorEvaluateResource\Pages;
use App\Filament\Resources\EvaluationResource\Pages\DoEvaluation;
use App\Filament\Resources\AssessorEvaluateResource\RelationManagers;

class AssessorEvaluateResource extends Resource
{
    protected static ?string $model = Evaluation::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Scoring & Result';
    protected static ?string $navigationLabel = 'Assessor Evaluation';
    protected static ?string $title = 'Assessor Evaluation';

    public static function canCreate(): bool
    {
        return false;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
               TextColumn::make('formation_selection.participant.name'),
               TextColumn::make('date')
               ->label('Start Date'),
               Tables\Columns\TextColumn::make('total_Score')   
               ->getStateUsing(function (Evaluation $record) {
                   // Hitung total score dari relasi examAnswers
                   return $record->evaluationDetails()->sum('score');
               })
            ])
            ->filters([
                //
            ])
            ->actions([
            
                Action::make('assessor-evaluate')
                ->label('Check Now')
                ->url(fn ($record): string => AssessorEvaluateResource::getUrl('assessor-do-evaluate', ['record' => $record->id]))
                // ->url(fn ($record): string => EvaluationResource::getUrl('do-evaluation', ['record' => $record]))
                ->icon('heroicon-s-document-text')
                ->color('primary'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAssessorEvaluates::route('/'),
            'create' => Pages\CreateAssessorEvaluate::route('/create'),
            'edit' => Pages\EditAssessorEvaluate::route('/{record}/edit'),
            'assessor-do-evaluate' => Pages\AssessorDoEvaluate::route('/{record}/assessor-do-evaluate'),
        ];
    }
}
