<?php

namespace App\Filament\Auth;

use App\Models\User;
use App\Models\Village;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Forms\Form;
use App\Models\Districts;
use App\Models\Participant;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Illuminate\Support\Facades\Storage;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Illuminate\Container\Attributes\Auth;
use Filament\Pages\Auth\Register as AuthRegister;

class Register extends AuthRegister
{
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
            $this->getEmailFormComponent(),
            $this->getPasswordFormComponent(),
            $this->getPasswordConfirmationFormComponent(),

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
    protected function handleRegistration(array $data): User
    {
        return DB::transaction(function () use ($data) {
            // 1. Buat user terlebih dahulu
            $user = User::create([
                'name' => $data['name'],
                'username' => $data['username'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
            ]);
            $imagePath = null;
            if (isset($data['image'])) {
                $imagePath = $this->handleImageUpload($data['image']);
            }
            // 2. Buat participant dengan relasi ke user
            Participant::create([
                'user_id' => $user->id,
                'nik' => $data['nik'],
                'name' => $data['name'],
                'email' => $data['email'],
                'telp' => $data['telp'],
                'place_of_birth' => $data['place_of_birth'],
                'date_of_birth' => $data['date_of_birth'],
                'gender' => $data['gender'],
                'religion' => $data['religion'],
                'address' => $data['address'],
                'district_id' => $data['district_id'],
                'village_id' => $data['village_id'],
                'image' => $imagePath,
            ]);

            return $user;
        });
    }

    private function handleImageUpload($file): ?string
{
    // Jika file baru diupload
    if ($file instanceof \Illuminate\Http\UploadedFile) {
        return $file->store('participants', 'public');
    }
    
    // Jika edit dan sudah ada path (string)
    if (is_string($file)) {
        return $file;
    }
    
    return null;
}
}
