<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use App\Models\Formation;
use Filament\Tables\Table;
use App\Models\Participant;
use Filament\Resources\Resource;
use App\Models\Formation_Selection;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\FormationSelectionResource\Pages;
use PhpOffice\PhpSpreadsheet\Calculation\LookupRef\Selection;
use App\Filament\Resources\FormationSelectionResource\RelationManagers;

class FormationSelectionResource extends Resource
{
    protected static ?string $model = Formation_Selection::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    
    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->with('participant');
    }
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('formation_id')
                ->label('Formasi')
                ->options(Formation::pluck('name', 'id'))
                ->live(),
                Select::make('participant_id')
                ->label('Participant')
                ->options(Participant::pluck('name', 'id'))
                ->unique()
                    ->validationMessages([
                        'unique' => 'Participant Allready Register',
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
               TextColumn::make('formation.name'),
               TextColumn::make('participant.name'),
               TextColumn::make('status')
               ->badge()
               ->color(fn (string $state): string => match ($state) {
                   'progress' => 'warning',
                   'accepted' => 'success',
                   'rejected' => 'danger',
                   default => 'gray',
               }),
            ])
            ->filters([
                SelectFilter::make('formation')
                ->relationship('formation', 'name')
                ->indicator('Formasi')
                ->multiple()
                ->searchable()
                ->preload()
                ->label('Filter berdasarkan Formasi')
                ->placeholder('Semua Formasi'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make()
                ->url(function ($record) {
                    return static::getUrl('view', ['record' => $record]);
                }),
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
            'index' => Pages\ListFormationSelections::route('/'),
            'create' => Pages\CreateFormationSelection::route('/create'),
            'edit' => Pages\EditFormationSelection::route('/{record}/edit'),
            'view' => Pages\DetailFormationSelection::route('/{record}/view'),
        ];
    }
}
