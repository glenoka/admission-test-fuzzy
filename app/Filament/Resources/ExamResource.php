<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\Exam;
use Filament\Tables;
use App\Models\Package;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\Participant;
use Filament\Resources\Resource;
use App\Models\Formation_Selection;
use Filament\Tables\Actions\Action;
use Illuminate\Support\Facades\Auth;
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
    protected static ?string $navigationLabel = 'Tryout';
    protected static ?string $navigationGroup='Tryout';
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('package_id')
                    ->label('Select Package')
                    ->relationship('package', 'name')
                    ->live()
                    ->afterStateUpdated(function (Set $set, ?string $state) {
                        $set('participant_id', null);
                        if ($state) {

                            $package = Package::find($state);
                            $set('duration', $package->duration);
                        }
                    })->required(),
                Select::make('participant_id')
                    ->label('Select Participant')
                    ->options(function (Get $get) {
                        $packageId = $get('package_id');
        
                        if (!$packageId) {
                            return [];
                        }
                        $package = Package::find($packageId);
                        $formationId = $package->formation_id;

                        return Formation_Selection::with('participant')
                            ->where('status', 'accepted')
                            ->where('formation_id', $formationId)
                            ->get()
                            ->pluck('participant.name', 'participant.id');
                    })->required(),
                Select::make('assessor_id')
                    ->label('Select Assessor')
                    ->relationship('assessor', 'name')
                    ->required(),
                
                TextInput::make('duration')->readOnly(),


            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
        ->defaultSort('created_at', 'desc')
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
                Tables\Actions\EditAction::make()
                ->visible(function ($record) {
                    return $record->started_at == null && Auth::user()->hasRole('super_admin');
                }),
                Action::make('start_test')
                ->label('Started')
                ->icon('heroicon-o-play')
                ->color('success')
                ->url(function ($record) {
                    return $record->package->type_package == 'option' 
                        ? route('do-exam', $record) 
                        : route('do-exam-essay', $record);
                })
                ->visible(function ($record) {
                    return $record->finish_at == null && Auth::user()->hasRole('participant');
                })
                ->openUrlInNewTab(),
                Tables\Actions\Action::make('scoring')
                ->url(fn ($record): string => ExamResource::getUrl('scoring', ['record' => $record]))
                ->icon('heroicon-o-star')
                ->visible(function($record){
                    return $record->package->type_package == 'essay' && $record->started_at != null && Auth::user()->hasRole('assessor');
                })
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
            'scoring' => Pages\AssessorScoringEssay::route('/{record}/scoring'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        $query= parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
        $role=Auth::user()->roles->first()->name;
     
        if($role=="participant"){
            return $query->whereHas('participant', function ($query) {
                $query->where('user_id', Auth::user()->id);
            });
        }

        if($role=="assessor"){
            return $query->whereHas('assessor', function ($query) {
                $query->where('user_id', Auth::user()->id);
            });
           
        }
    
       
        return $query;
    }
}
