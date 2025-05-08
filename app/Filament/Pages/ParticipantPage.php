<?php

namespace App\Filament\Pages;

use App\Models\Village;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Forms\Form;
use Filament\Pages\Page;
use App\Models\Districts;
use App\Models\Participant;
use Filament\Infolists\Infolist;
use function Laravel\Prompts\select;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Filament\Forms\Components\Select;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\Textarea;
use Illuminate\Support\Facades\Storage;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Infolists\Components\Actions;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\ImageEntry;
use BezhanSalleh\FilamentShield\Traits\HasPageShield;

class ParticipantPage extends Page
{
    use HasPageShield;
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.participant-page';

    protected static ?string $title = 'Participant Page';
    
  
    public ?array $data = [];
    public $user;
    public $participant;
   

    public function mount(): void
    {
       
        $this->user = auth::user()->id;
        $this->participant = Participant::where('user_id', $this->user)->with('user')->first();
        // Set flag isEmpty menjadi true jika participant kosong
   
   

        $this->form->fill([
            'name' => $this->participant->name,
            'nik' => $this->participant->nik,
            'place_of_birth' => $this->participant->place_of_birth,
            'date_of_birth' =>$this->participant->date_of_birth,
            'gender' => $this->participant->gender,
            'religion' => $this->participant->religion,
            'village_id' => $this->participant->village_id,
            'telp' => $this->participant->telp,
            'email' => $this->participant->email,
            'address' => $this->participant->address,
            'image' => $this->participant->image,
            'user_id' => $this->participant->user_id,
            'status' => $this->participant->status,
            'username'=>$this->participant->user->username
        ]);
    
    }

    public function form(Form $form): Form
    {

        return $form
            ->schema([
                TextInput::make('name'),
                TextInput::make('nik'),
                TextInput::make('place_of_birth'),
                DatePicker::make('date_of_birth'),
                Select::make('gender')
                    ->options(
                        [
                            'female' => 'Female',
                            'male' => 'Male',
                        ]
                    ),
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
                Select::make('district_id')
                    ->label('District')
                    ->options(Districts::pluck('name', 'id'))
                    ->live()
                    ->afterStateUpdated(fn(Set $set) => $set('village_id', null))
                    ->required(),

                Select::make('village_id')
                    ->label('Village')
                    ->default($this->participant->village_id)
                    ->options(function (Get $get) {
                        $districtId = $get('district_id');

                        if (!$districtId) {
                            return Village::query()->limit(50)->pluck('name', 'id');
                        }

                        return Village::where('district_id', $districtId)->pluck('name', 'id');
                    })
                    ->searchable()
                    ->required()
                    ->live()
                    ->placeholder('Select Village')
                    ->disabled(fn(Get $get): bool => !$get('district_id'))
                    ->afterStateHydrated(function (Set $set, ?string $state) {
                        if ($state) {
                            $dataVillage = Village::find($state);
                            if ($dataVillage) {
                                $set('district_id', $dataVillage->district_id);
                            }
                        }
                    }),
                    TextInput::make('telp'),
                    TextInput::make('email'),
                    Textarea::make('address'),
                    TextInput::make('image')
                    ->type('file'),

                    TextInput::make('username')->disabled(),
                    TextInput::make('user.password')->placeholder('Kosongkan jika tidak dirubah'),
                    
            ])->statePath('data');
    }
    public function participantInfo(Infolist $infolist): Infolist
    {
        return $infolist
            ->record($this->participant)
            ->schema([
                Section::make('Profile Information')
                    ->columns(3)
                    ->schema([
                        ImageEntry::make('image')
                            ->label('')
                            ->disk('public')
                            ->height(120)
                            ->width(120)
                            ->circular(),

                        TextEntry::make('name')
                            ->label('Nama Lengkap')
                            ->size(TextEntry\TextEntrySize::Large),

                        TextEntry::make('email')
                            ->icon('heroicon-o-envelope'),

                    ]),

                Section::make('Biodata')
                    ->columns(2)
                    ->schema([
                        TextEntry::make('nik')
                            ->label('NIK')
                            ->icon('heroicon-o-identification'),

                        TextEntry::make('place_of_birth')
                            ->label('Tempat Lahir')
                            ->icon('heroicon-o-map-pin'),

                        TextEntry::make('gender')
                            ->label('Jenis Kelamin')
                            ->icon('heroicon-o-user'),

                        TextEntry::make('religion')
                            ->label('Agama')
                            ->icon('heroicon-o-heart'),

                        TextEntry::make('village.name')
                            ->label('Desa/Kelurahan')
                            ->icon('heroicon-o-home-modern'),

                        TextEntry::make('telp')
                            ->label('Telepon')
                            ->icon('heroicon-o-phone'),
                    ]),

                Section::make('Alamat Lengkap')
                    ->schema([
                        TextEntry::make('address')
                            ->label('')
                            ->columnSpanFull()
                            ->markdown()
                            ->prose(),
                    ]),

                Section::make('Status')
                    ->schema([
                        TextEntry::make('status')
                            ->badge()
                            ->color(fn(string $state): string => match ($state) {
                                'active' => 'success',
                                'inactive' => 'danger',
                                default => 'gray',
                            }),
                    ]),

            ]);
    }

    public function edit(): void
    {
        
        $validateData = $this->form->getState();
        $this->participant->update([
            'name' => $validateData['name'],
            'nik'=>$validateData['nik'],
            'gender' =>$validateData['gender'],
            'religion' =>$validateData['religion'],
            'village_id'=>$validateData['village_id'],
            'telp'=>$validateData['telp'],
            'place_of_birth'=>$validateData['place_of_birth'],
            'date_of_birth'=>$validateData['date_of_birth'],
            'address'=>$validateData['address'],
            'email'=>$validateData['email'],

        ]);
        $this->participant->name=$validateData['name'];
        if (!empty($validateData['password'])) {
            $this->user->password = Hash::make($validateData['password']);
        }

        if(isset($validateData['image'])){
            if($this->participant->image){
                Storage::delete($this->participant->image);
            }
            $this->participant->image=$validateData['image'];
        }

        Notification::make('update')
        ->title('Data terupdate')
        ->success()
        ->body('Data anda sudah terupdate')
        ->send();
    }
}
