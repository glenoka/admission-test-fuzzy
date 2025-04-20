<x-filament::page>
    
        <!-- Form Section -->
       
            {{ $this->form }}
            <div class="flex justify-end gap-4 pt-6">
        <button wire:click="reject" type="button" 
                class="filament-button inline-flex items-center justify-center py-1 gap-1 font-medium rounded-lg border transition-colors focus:outline-none focus:ring-offset-2 focus:ring-2 focus:ring-inset filament-button-color-danger filament-page-button-action">
            Reject
        </button>
        
        <button wire:click="approve" type="button"
                class="filament-button inline-flex items-center justify-center py-1 gap-1 font-medium rounded-lg border transition-colors focus:outline-none focus:ring-offset-2 focus:ring-2 focus:ring-inset filament-button-color-success filament-page-button-action">
            Approve
        </button>
    </div>
    
</x-filament::page>