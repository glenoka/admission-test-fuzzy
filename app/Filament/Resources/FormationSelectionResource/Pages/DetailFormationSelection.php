<?php

namespace App\Filament\Resources\FormationSelectionResource\Pages;

use Livewire\Component;
use Filament\Forms\Form;
use Filament\Actions\Action;
use Filament\Resources\Pages\Page;
use Illuminate\Support\Facades\DB;
use App\Models\Formation_Selection;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Forms\Components\FileUpload;
use App\Filament\Resources\FormationSelectionResource;

class DetailFormationSelection extends Page 
{
    protected static string $resource = FormationSelectionResource::class;
    protected static string $view = 'filament.resources.formation-selection-resource.pages.detail-formation-selection';
   

    public $record;
    public ?array $data = [];
    public function mount(Formation_Selection $record): void
    {
       // $this->record = $record->load('participant');
        $this->form->fill([
            'name' => $this->record->participant->name,
            'nik' => $this->record->participant->nik,
            'email' => $this->record->participant->email,
            'tlp' => $this->record->participant->telp,
            'image' => $this->record->participant->image,
            'place_of_birth' => $this->record->participant->place_of_birth,
            'date_of_birth' => $this->record->participant->date_of_birth,
            'gender' => $this->record->participant->gender,
            'religion' => $this->record->participant->religion,
            'address' => $this->record->participant->address,
            'village' => $this->record->participant->village->name,
            'formation_name' => $this->record->formation->name,
        ]);
        
       
       
    }
    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Form Edit Biodata')
                ->description(fn ($record) => 'Formasi : ' . $this->record->formation->name)
                    ->schema([
                        TextInput::make('name')->required()->readOnly(),
                        TextInput::make('nik')->required()->readOnly(),
                        TextInput::make('place_of_birth')->required()->readOnly(),
                        TextInput::make('date_of_birth')->required()->readOnly(),
                        TextInput::make('email')->required()->readOnly(),
                        TextInput::make('tlp')->required()->readOnly(),
                        FileUpload::make('image')->image()->columnSpanFull(),
                        TextArea::make('address')->required(),
                        TextInput::make('village')
                            ->label('Village')
                            ->readOnly()
                            ->default($this->record->participant->village->name),
                        Select::make('religion')
                        ->disabled()
                            ->options([
                                'islam' => 'Islam',
                                'kristen' => 'Kristen',
                                'katolik' => 'Katolik',
                                'hindu' => 'Hindu',
                                'budha' => 'Budha',
                            ])
                            ->required(), 
                    ])->columns(2),
               
            ])->statePath('data');
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('approve')
                ->button()
                ->color('success')
                ->icon('heroicon-o-check-circle')
                ->action(function () {
                    DB::table('formation_selections')
                    ->where('id', $this->record->id)
                    ->update(['status' => 'accepted']);
                    Notification::make()
                        ->title('Approved Successfully')
                        ->success()
                        ->send();
                })
                ->visible(fn () => $this->record->status !== 'accepted  '),
                
            Action::make('reject')
                ->button()
                ->color('danger')
                ->icon('heroicon-o-x-circle')
                ->action(function () {
                    DB::table('formation_selections')
                    ->where('id', $this->record->id)
                    ->update(['status' => 'rejected']);
                    Notification::make()
                        ->title('Rejected Successfully')
                        ->warning()
                        ->send();
                })
                ->visible(fn () => $this->record->status !== 'rejected'),
        ];
    }
    

}
