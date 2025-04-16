<x-filament-panels::page>
    <x-filament-panels::header
        :title="'Penilaian Jawaban - ' . $this->exam->participant->name"
        :actions="[
            \Filament\Actions\Action::make('save')
                ->label('Simpan Nilai')
                ->button()
                ->color('primary')
                ->action('saveScores'),
        ]"
    />

    <form wire:submit.prevent="saveScores">
        {{ $this->form }}
        
        <x-filament::button type="submit" class="mt-6">
            Simpan Semua Nilai
        </x-filament::button>
    </form>
</x-filament-panels::page>