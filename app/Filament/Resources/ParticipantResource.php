<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\User;
use Filament\Tables;
use App\Models\Village;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Forms\Form;
use App\Models\Districts;
use Filament\Tables\Table;
use App\Models\Participant;
use Filament\Resources\Resource;
use Illuminate\Support\Facades\Hash;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Illuminate\Support\Facades\Storage;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\ParticipantResource\Pages;
use App\Filament\Resources\ParticipantResource\RelationManagers;

class ParticipantResource extends Resource
{
    protected static ?string $model = Participant::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Profile Admin')
                    ->description('Profile Data Admin ')
                    ->schema([
                        TextInput::make('name')
                            ->reactive()
                            // Memperbaiki copy email ke field email user
                            ->afterStateUpdated(function (Set $set, ?string $state) {
                                if ($state) {
                                    $set('user.name', $state);
                                }
                            }),
                        TextInput::make('user_id')->hidden()
                            ->live()
                            ->afterStateHydrated(function (Set $set, ?string $state) {
                                $dataUser = User::find($state);
                                if ($dataUser) {
                                    $set('user.name', $dataUser->name);
                                    $set('email', $dataUser->email);
                                    $set('username', $dataUser->username);
                                }
                            }),
                        TextInput::make('nik'),
                        TextInput::make('place_of_birth'),
                        DatePicker::make('date_of_birth'),
                        Select::make('gender')
                            ->options([
                                'male' => 'Laki-laki',
                                'female' => 'Perempuan',
                            ]),
                        Select::make('religion')
                            ->options([
                                'islam' => 'Islam',
                                'kristen' => 'Kristen',
                                'katolik' => 'Katolik',
                                'hindu' => 'Hindu',
                                'budha' => 'Budha',
                                'konghucu' => 'Konghucu',
                                'lainnya' => 'Lainnya',
                            ]),
                        Textarea::make('address'),
                        TextInput::make('email')
                            ->reactive()
                            // Memperbaiki copy email ke field email user
                            ->afterStateUpdated(function (Set $set, ?string $state) {
                                if ($state) {
                                    $set('user.email', $state);
                                }
                            }),

                        TextInput::make('telp'),
                        Select::make('district_id')
                            ->label('District')
                            ->options(Districts::pluck('name', 'id'))
                            ->live()
                            ->afterStateUpdated(fn(Set $set) => $set('village_id', null)),

                        Select::make('village_id')
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
                        TextInput::make('status')
                            ->default('active')
                            ->disabled(),
                        FileUpload::make('image')->image()
                            ->directory('participant')->columnSpanFull()
                            ->deleteUploadedFileUsing(
                                function ($state) {
                                    if ($state) {
                                        Storage::disk('public')->delete($state);
                                    }
                                }
                            ),


                    ])->columns(2),
                Section::make('Data User')
                    // Menghapus relationship karena akan dihandle manual
                    ->schema([
                        TextInput::make('user.name')->disabled(),
                        TextInput::make('username')->disabled(fn(string $context) => $context === 'update'),
                        TextInput::make('user.email')
                            ->email()
                            ->disabled(),
                        TextInput::make('password')
                            ->password()
                            ->revealable(filament()->arePasswordsRevealable())
                            ->dehydrateStateUsing(fn($state) => Hash::make($state))
                            ->dehydrated(fn($state) => filled($state))
                            ->required(fn(string $context) => $context === 'create'),


                    ])

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
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
            'index' => Pages\ListParticipants::route('/'),
            'create' => Pages\CreateParticipant::route('/create'),
            'edit' => Pages\EditParticipant::route('/{record}/edit'),
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
