<x-filament-panels::page>


{{ $this->participantInfo }}
<x-filament::section>
<x-slot name="heading">
Form Edit Participant
    </x-slot>
    <form  wire:submit.prevent="edit" class="space-y-4">
    
    {{$this->form}}
    <x-filament::button type="submit" color="primary">
            Submit
    </x-filament::button>
    </form>
</x-filament::section>


</x-filament-panels::page>
