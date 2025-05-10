<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Section;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\SectionResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\SectionResource\RelationManagers;
use Filament\Tables\Columns\TextColumn;

class SectionResource extends Resource
{
    protected static ?string $model = Section::class;

    protected static ?string $navigationIcon = 'heroicon-o-cube-transparent';
    protected static ?string $navigationLabel = 'Data Penilaian Praktek';
    protected static ?string $navigationGroup='Manajemen Soal';
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                ->label('Section Name'),
                Repeater::make('aspects')
                    ->relationship() // Membuat relationship dengan Aspect
                    ->schema([
                        Forms\Components\TextInput::make('task')
                            ->required()
                            ->label('Task/Aspek Penilaian'),
                            
                        Forms\Components\TextInput::make('max_score')
                            ->required()
                            ->numeric()
                            ->label('Nilai Maksimal')
                            ->minValue(1),
                    ])
                    ->columns(2)
                    ->columnSpan('full')
                    ->label('Daftar Aspek Penilaian')
                  
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
              TextColumn::make('name'),
              Tables\Columns\TextColumn::make('aspects_count')
              ->counts('aspects')
              ->label('Jumlah Aspek'),
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
            'index' => Pages\ListSections::route('/'),
            'create' => Pages\CreateSection::route('/create'),
            'edit' => Pages\EditSection::route('/{record}/edit'),
        ];
    }
}
