<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Package;
use App\Models\Creteria;
use App\Models\Criteria;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Repeater;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\PackageResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\PackageResource\RelationManagers;

class PackageResource extends Resource
{
    protected static ?string $model = Package::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Group::make()
                    ->schema([
                        Section::make()
                            ->schema([
                                Forms\Components\TextInput::make('name')
                                    ->required()
                                    ->maxLength(255),
                                Forms\Components\TextInput::make('duration')
                                    ->required()
                                    ->numeric(),
                                Forms\Components\Select::make('type_package')
                                    ->options([
                                        'option' => 'Multiple Choice',
                                        'essay' => 'Essay',
                                    ])
                                    ->required()
                                    ->label('Tipe Soal'),
                                
                                Forms\Components\Select::make('criteria_id')
                                    ->options(Criteria::pluck('criteria', 'id'))
                                    ->required()
                                    ->label('Creteria'),
                                    Forms\Components\Select::make('formation_id')
                                    ->label('Formasi')
                                    ->relationship('formation', 'name')
                                    ->required()
                                    ->label('Formation')
                                    ->columnSpanFull(),
                            ])->columns(2),
                    ]),
                Repeater::make('package_questions')
                    ->relationship('package_questions')
                    ->schema([
                        Select::make('question_id')
                            ->relationship('question', 'question')
                            ->label('Soal')
                            ->getOptionLabelFromRecordUsing(fn($record) => "{$record->question} - [{$record->question_type}]")
                            ->disableOptionsWhenSelectedInSiblingRepeaterItems()
                            ->required(),
                    ])
            ])->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('duration')
                    ->numeric()
                    ->label('Menit')
                    ->sortable(),
                Tables\Columns\TextColumn::make('type_package')
                    ->label('Tipe Paket'),
                Tables\Columns\TextColumn::make('package_questions_count')
                    ->counts('package_questions')
                    ->label('Jumlah Soal')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('criteria.criteria')
                    ->label('Creteria'),
                Tables\Columns\TextColumn::make('formation.name'),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
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
            'index' => Pages\ListPackages::route('/'),
            'create' => Pages\CreatePackage::route('/create'),
            'edit' => Pages\EditPackage::route('/{record}/edit'),
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
