<?php

namespace App\Filament\Resources\AssessorResource\Pages;

use App\Models\User;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\AssessorResource;

class CreateAssessor extends CreateRecord
{
    protected static string $resource = AssessorResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $formData = $this->form->getState();

       $saveUser=User::create([
            'name' => $formData['name'],
            'username' => $formData['username'],
            'email' => $formData['email_assessor'],
            'password' => bcrypt($formData['password']),
        ]);

        $formData['user_id'] = $saveUser->id;

    return $formData;
    }




}
