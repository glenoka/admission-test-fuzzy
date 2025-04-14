<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\Exam;
use Filament\Tables;
use App\Models\Package;
use Filament\Forms\Set;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Tables\Actions\Action;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\ExamResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\ExamResource\RelationManagers;

class ExamResource extends Resource
{
    protected static ?string $model = Exam::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('participant_id')
                    ->label('Select Participant')
                    ->searchable()
                    ->relationship('participant', 'name'),
                Select::make('assessor_id')
                    ->label('Select Assessor')
                    ->relationship('assessor', 'name'),
                Select::make('package_id')
                    ->label('Select Package')
                    ->relationship('package', 'name')
                    ->live()
                    ->afterStateUpdated(function (Set $set, ?string $state) {
                        if ($state) {

                            $package = Package::find($state);
                            $set('duration', $package->duration);
                        }
                    }),
                TextInput::make('duration')->readOnly(),


            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('participant.name'),
                TextColumn::make('assessor.name'),
                TextColumn::make('package.name'),
                TextColumn::make('started_at')
                ->default('Not Started'),


            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Action::make('start_test')
                ->label('Started')
                ->icon('heroicon-o-play')
                ->color('success')
                ->url(function ($record) {
                    return $record->package->package_type == 'option' 
                        ? route('do-exam', $record) 
                        : route('do-exam-essay', $record);
                })
                ->openUrlInNewTab()
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
            'index' => Pages\ListExams::route('/'),
            'create' => Pages\CreateExam::route('/create'),
            'edit' => Pages\EditExam::route('/{record}/edit'),
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
