<?php

namespace App\Livewire;

use App\Models\Formation;
use Livewire\Component;
use Livewire\Attributes\Session;

class HomePage extends Component
{
    
    
    public $search = '';
    public $formasi;
    public $perPage = 3;
    public $loaded = 3;
   
    
    public function loadMore()
    {
        $this->loaded += $this->perPage;
    }
    
    
    
    public function render()
    {
        $dataformasi = Formation::when($this->search, function($query) {
            return $query->where('name', 'like', '%'.$this->search.'%');
        })
        ->with(['village', 'district'])
      
        ->paginate($this->loaded);

        return view('livewire.home-page',compact('dataformasi'))
        ->layout('layouts.homepage.layouts.main', [
            'title' => 'Home - My Awesome App' // Kirim data ke layout
        ]);;
    }
}
