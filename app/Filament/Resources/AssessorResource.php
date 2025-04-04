<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Set;
use App\Models\Assessor;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Group;
use Illuminate\Support\Facades\Hash;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\AssessorResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\AssessorResource\RelationManagers;

class AssessorResource extends Resource
{
    protected static ?string $model = Assessor::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Profile Assessor')
                    ->description('Profile Assessor Data ')
                    ->schema([
                        TextInput::make('name')
                        ->reactive()
                        // Memperbaiki copy email ke field email user
                        ->afterStateUpdated(function (Set $set, ?string $state) {
                            if ($state) {
                                $set('user.name', $state);
                            }
                        }),
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
                        TextInput::make('email_assessor')
                        ->reactive()
                        // Memperbaiki copy email ke field email user
                        ->afterStateUpdated(function (Set $set, ?string $state) {
                            if ($state) {
                                $set('user.email', $state);
                            }
                        }),

                        TextInput::make('telp'),
                        Select::make('village_id')
                            ->relationship('village', 'name')
                            ->searchable(),
                        TextInput::make('status')
                            ->default('active'),
                        FileUpload::make('image')->image()->directory('assessor')->columnSpanFull(),
                    ])->columns(2),
                    Section::make('Data User')
                    // Menghapus relationship karena akan dihandle manual
                    ->schema([
                        TextInput::make('user.name')->disabled(),
                        TextInput::make('user.username'),
                        TextInput::make('user.email')
                            ->email()
                            ->disabled(),
                        TextInput::make('user.password')
                            ->password()
                            ->revealable(filament()->arePasswordsRevealable())
                            ->dehydrateStateUsing(fn ($state) => Hash::make($state))
                            ->dehydrated(fn ($state) => filled($state))
                            ->required(fn (string $context) => $context === 'create'),
                        TextInput::make('user.password_confirmation')
                            ->password()
                            ->required(fn (string $context) => $context === 'create'),
                    ])

            ]);
    }

    public static function mutateFormDataBeforeCreate(array $data): array
    {
        // Membuat user baru
        $userData = $data['user'];
        $user = \App\Models\User::create([
            'username' => $userData['username'],
            'email' => $userData['email'],
            'password' => $userData['password'],
        ]);

        // Menghapus data user dari array dan menambahkan user_id
        unset($data['user']);
        $data['user_id'] = $user->id;

        return $data;
    }

    public static function mutateFormDataBeforeUpdate(array $data, $record): array
    {
        if (isset($data['user'])) {
            $userData = $data['user'];

            // Update user yang ada
            $user = $record->user;
            $user->update([
                'username' => $userData['username'],
                'email' => $userData['email'],
            ]);

            // Update password jika diisi
            if (!empty($userData['password'])) {
                $user->update([
                    'password' => $userData['password'],
                ]);
            }

            // Menghapus data user dari array
            unset($data['user']);
        }

        return $data;
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
            'index' => Pages\ListAssessors::route('/'),
            'create' => Pages\CreateAssessor::route('/create'),
            'edit' => Pages\EditAssessor::route('/{record}/edit'),
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
