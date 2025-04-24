<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\Exam;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\EssayResult;
use Filament\Resources\Resource;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\EssayResultResource\Pages;
use App\Filament\Resources\EssayResultResource\RelationManagers;
use Dom\Text;

class EssayResultResource extends Resource
{

    protected static ?string $model = \App\Models\Exam::class;
    protected static ?string $modelLabel = 'Essay Exam'; // Custom label
    protected static ?string $navigationLabel = 'Result Essay'; // Label khusus
    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';
    protected static ?string $navigationGroup = 'Scoring & Result';
    protected static bool $shouldRegisterNavigation = true;
    public static function canCreate(): bool
    {
        return false;
    }

    public static function form(Form $form): Form
    {
        return $form
        
            ->schema([
                Section::make('Essay Result')
                    ->schema([
                        Repeater::make('answers')
                        ->label('Essay Result')
                        ->relationship('answers')
                        ->schema([
                            Textarea::make('question_text')
                                ->label('Soal')
                                ->disabled()
                                ->columnSpan(1)
                                ->afterStateHydrated(function ($component, $record) {
                                    $component->state($record->question->question);
                                }),
    
                            Textarea::make('answer_key')
                                ->label('Kunci Jawaban')
                                ->disabled()
                                ->columnSpan(1)
                                ->afterStateHydrated(function ($component, $record) {
                                    $component->state($record->question->essay_answer_key);
                                }),
    
                            Textarea::make('essay_answer')
                                ->label('Jawaban Essay')
                                ->readOnly()
                                ->columnSpanFull(),
    
                            TextInput::make('score')
                                ->label('Score')
                                ->numeric()
                                ->required()
                                ->minValue(0)
                                ->maxValue(100)
                                ->columnSpan(1)
                        ])
                        ->columns(2) // ← INI YANG PALING PENTING
                        ->disableItemCreation()
                        ->disableItemDeletion()
                        ->disableItemMovement()
    
                
       
                    ])

            ]);
            }

    public static function table(Table $table): Table
    {
        return $table
            ->query(
                static::getModel()::query()
                    ->with(['answers', 'package', 'participant'])
                    ->whereNotNull('started_at')
                    ->whereHas('package', fn($q) => $q->where('type_package', 'essay'))
            )
            ->columns([

                TextColumn::make('participant.name')
                    ->label('Nama Peserta'),

                TextColumn::make('started_at')
                    ->label('Tanggal Ujian')
                    ->dateTime(),
                TextColumn::make('Score')
                    ->label('Score')
                    ->getStateUsing(function (Exam $record) {
                        // Hitung total score dari relasi examAnswers
                        return $record->answers->sum('score');
                    })
            ])

            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()->label('Scoring'),
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
            'index' => Pages\ListEssayResults::route('/'),
            'create' => Pages\CreateEssayResult::route('/create'),
            'edit' => Pages\EditEssayResult::route('/{record}/edit'),
        ];
    }
}
