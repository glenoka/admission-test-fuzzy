<?php

namespace App\Filament\Resources\ParticipantResource\Pages;

use App\Models\User;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\ParticipantResource;

class CreateParticipant extends CreateRecord
{
    protected static string $resource = ParticipantResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $formData = $this->form->getState();

       $saveUser=User::create([
            'name' => $formData['name'],
            'username' => $formData['username'],
            'email' => $formData['email'],
            'password' => $formData['password'],
        ]);

        $formData['user_id'] = $saveUser->id;
        $saveUser->assignRole('participant');
    return $formData;
    }
}
