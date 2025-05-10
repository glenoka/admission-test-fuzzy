<?php

namespace App\Filament\Resources;

use Dom\Text;
use Filament\Forms;
use Filament\Tables;
use App\Models\Village;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Forms\Form;
use App\Models\Districts;
use App\Models\Formation;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\RichEditor;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\FormationResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\FormationResource\RelationManagers;

class FormationResource extends Resource
{
    protected static ?string $model = Formation::class;

    protected static ?string $navigationIcon = 'heroicon-o-identification';
    protected static ?string $navigationLabel = 'Formasi';
    protected static ?string $navigationGroup='Manajemen Formasi';
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name'),
                Select::make('district_id')
                    ->label('District')
                    ->options(Districts::pluck('name', 'id'))
                    ->live()
                    ->afterStateUpdated(fn(Set $set) => $set('village_id', null)),

                Select::make('village_id')->required()
                    ->label('Village')
                    ->options(function (Get $get) {
                        $districtId = $get('district_id');

                        if (!$districtId) {
                            return [];
                        }

                        return Village::where('district_id', $districtId)
                            ->pluck('name', 'id');
                    })
                    ->searchable(),
                    DatePicker::make('due_date')
                    ->label('Due Date')
                    ->required(),
                TextInput::make('status')
                    ->label('Status')
                    ->required()
                    ->default('active'),
                TextInput::make('education_level')
                    ->label('Education Level')
                    ->required(),
                TextInput::make('open_position')
                    ->label('Open Position')
                    ->required(),
                RichEditor::make('description'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name'),
                TextColumn::make('Participants'),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
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
            'index' => Pages\ListFormations::route('/'),
            'create' => Pages\CreateFormation::route('/create'),
            'edit' => Pages\EditFormation::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
