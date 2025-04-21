<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use App\Models\Evaluation;
use Filament\Tables\Table;
use Tabs\Actions\ActionGroup;
use Filament\Resources\Resource;
use App\Models\Formation_Selection;
use Filament\Tables\Actions\Action;
use Filament\Forms\Components\Tabs\Tab;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\EvaluationResource\Pages;
use PhpOffice\PhpSpreadsheet\Calculation\LookupRef\Selection;
use App\Filament\Resources\EvaluationResource\RelationManagers;
use App\Models\Evaluation_details;

class EvaluationResource extends Resource
{
    protected static ?string $model = Evaluation::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('assessor_id')
                    ->relationship('assessor', 'name')
                    ->required()
                    ->label('Assessor'),
                Forms\Components\Select::make('formation_selection_id')
                    ->relationship(
                        name: 'formation_selection',
                        modifyQueryUsing: fn(Builder $query) => $query
                            ->with('participant')
                            ->where('status', 'accepted')
                    )
                    ->getOptionLabelFromRecordUsing(fn(Formation_Selection $record) => $record->participant->name)
                    ->required()
                    ->unique()
                    ->label('Participant'),
                Forms\Components\DatePicker::make('date')
                    ->required()
                    ->label('Date')
                    ->default(now()),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('assessor.name')
                    ->label('Assessor')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('formation_selection.participant.name')
                    ->label('Participant')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('date')
                    ->label('Date')
                    ->dateTime()
                    ->sortable()
                    ->searchable(),
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
                Tables\Actions\EditAction::make(),
                Action::make('doEvaluation')
                ->label('Evaluate')
                ->url(fn ($record): string => EvaluationResource::getUrl('do-evaluation', ['record' => $record->id]))
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
            'index' => Pages\ListEvaluations::route('/'),
            'create' => Pages\CreateEvaluation::route('/create'),
            'edit' => Pages\EditEvaluation::route('/{record}/edit'),
            'do-evaluation' => Pages\DoEvaluation::route('/{record}/do-evaluation'),
        ];
    }
}
