<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Question;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\QuestionResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\QuestionResource\RelationManagers;

class QuestionResource extends Resource
{
    protected static ?string $model = Question::class;

    protected static ?string $navigationIcon = 'heroicon-o-bars-arrow-down';
    protected static ?string $navigationLabel = 'Data Soal';
    protected static ?string $navigationGroup='Manajemen Soal';
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('question'),
                

                // TextInput::make('slug') 
                //     ->default(function() {
                //         return strtoupper(Str::random(6));
                //     })
                //     ->disabled() // Agar tidak bisa diedit
                //     ->dehydrated(), //agar tetap isa disimpan ini ya
                RichEditor::make('description'),
                Select::make('question_type')
                ->reactive()
                ->options([
                    'options' => 'Options',
                    'essay' => 'Essay',
                ])
                ->required(),
                
            
            Textarea::make('essay_answer_key')
                ->reactive()
                ->visible(fn (callable $get) => $get('question_type') === 'essay'), // Tampil hanya jika essay
            
            Repeater::make('options')
                    ->reactive()
                    ->relationship('options')
                ->schema([
                    TextInput::make('option_text')->required(),
                    TextInput::make('score')->required()->numeric(),
                ])
                ->visible(fn (callable $get) => $get('question_type') === 'options') // Tampil hanya jika options
            
                    
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('question'),
                TextColumn::make('question_type'),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListQuestions::route('/'),
            'create' => Pages\CreateQuestion::route('/create'),
            'edit' => Pages\EditQuestion::route('/{record}/edit'),
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
