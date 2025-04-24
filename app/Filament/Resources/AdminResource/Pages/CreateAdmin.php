<?php

namespace App\Filament\Resources\AdminResource\Pages;

use App\Models\User;
use Filament\Actions;
use App\Filament\Resources\AdminResource;
use Filament\Resources\Pages\CreateRecord;

class CreateAdmin extends CreateRecord
{
    protected static string $resource = AdminResource::class;
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
        $saveUser->assignRole('admin');

    return $formData;
    }
}
