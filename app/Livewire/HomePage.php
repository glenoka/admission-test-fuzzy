<?php

namespace App\Livewire;

use App\Models\Formation;
use Livewire\Component;
use Livewire\Attributes\Session;

class HomePage extends Component
{
    
    
    public $search = '';

    
    public function render()
    {
        $formasi = Formation::when($this->search, function($query) {
            return $query->where('name', 'like', '%'.$this->search.'%');
        })
        ->limit(6) // Batasi untuk preview
        ->get();

        return view('livewire.home-page',compact('formasi'))
        ->layout('layouts.homepage.layouts.base', [
            'title' => 'Home - My Awesome App' // Kirim data ke layout
        ]);;
    }
}
