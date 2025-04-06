<?php

namespace App\Filament\Resources\ParticipantResource\Pages;

use App\Models\User;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Resources\ParticipantResource;

class EditParticipant extends EditRecord
{
    protected static string $resource = ParticipantResource::class;
    protected function mutateFormDataBeforeSave(array $data): array
    {
        $formData = $this->form->getState();


        $user = User::find($this->record->user_id);

        // Update data user jika ada password baru
        if (isset($formData['password']) && !empty($formData['password'])) {
            $user->update([
                'password' => bcrypt($formData['password'])
            ]);
        }

        return $formData;
    }
    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }
}
