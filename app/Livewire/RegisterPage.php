<?php

namespace App\Livewire;

use App\Models\User;
use App\Models\Village;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Livewire\Component;
use Filament\Forms\Form;
use App\Models\Districts;
use App\Models\Participant;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Illuminate\Support\Facades\Storage;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;


class RegisterPage extends Component implements HasForms
{
    use  InteractsWithForms;

    public function form(Form $form): Form
    {
        return $form->schema([
            TextInput::make('name')
                ->reactive()
                // Memperbaiki copy email ke field email user
                ->afterStateUpdated(function (Set $set, ?string $state) {
                    if ($state) {
                        $set('user.name', $state);
                    }
                }),
            TextInput::make('nik')->required()
                ->label('NIK')
                ->maxLength(16)
                ->minLength(16)
                ->numeric()
                ->unique(Participant::class, 'nik', ignoreRecord: true),
            TextInput::make('place_of_birth')->required(),
            DatePicker::make('date_of_birth'),
            Select::make('gender')->required()
                ->options([
                    'male' => 'Laki-laki',
                    'female' => 'Perempuan',
                ]),
            TextInput::make('telp')->required(),
            Select::make('religion')->required()
                ->options([
                    'islam' => 'Islam',
                    'kristen' => 'Kristen',
                    'katolik' => 'Katolik',
                    'hindu' => 'Hindu',
                    'budha' => 'Budha',
                    'konghucu' => 'Konghucu',
                    'lainnya' => 'Lainnya',
                ]),
            Textarea::make('address')->required(),
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
            FileUpload::make('image')->image()
                ->directory('participant')->columnSpanFull()
                ->deleteUploadedFileUsing(
                    function ($state) {
                        if ($state) {
                            Storage::disk('public')->delete($state);
                        }
                    }
                ),
            TextInput::make('username')->required()
                ->label('Username')
                ->maxLength(16)
                ->minLength(6)
                ->unique(User::class, 'username', ignoreRecord: true),
            TextInput::make('email')
                ->required()
                ->label('Email')
                ->maxLength(255)
                ->unique(User::class, 'email', ignoreRecord: true),
            TextInput::make('password')
                ->required()
                ->label('Password')
                ->password()
                ->minLength(8)
                ->maxLength(255)
                ->dehydrateStateUsing(function ($state) {
                    return bcrypt($state);
                }),
            TextInput::make('password_confirmation')
                ->required()
                ->label('Password Confirmation')
                ->password()
                ->minLength(8)
                ->maxLength(255)
                ->dehydrateStateUsing(function ($state) {
                    return bcrypt($state);
                }),
           

        ])
            ->statePath('data');
    }
    public function rules(): array
    {
        return [
            'username' => ['required', 'unique:users,username'],
            'email' => $this->getEmailValidationRules(),
            'password' => $this->getPasswordValidationRules(),
            'nik' => ['required', 'unique:participants,nik'],
            
        ];
    }
    public function render()
    {
        return view('livewire.register-page') 
        ->layout('layouts.homepage.layouts.main', [
            'title' => 'Register Page' // Kirim data ke layout
        ]);
    }
}
