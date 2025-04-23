<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AssessorEvaluateResource\Pages;
use App\Filament\Resources\AssessorEvaluateResource\RelationManagers;
use App\Models\AssessorEvaluate;
use App\Models\Evaluation;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

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
                //
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
        ];
    }
}
