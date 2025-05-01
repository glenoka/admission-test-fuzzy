<?php

namespace App\Livewire;


use Livewire\Component;

class HomePage extends Component
{

           
    public function render()
    {
        return view('livewire.home-page')
        ->layout('layouts.homepage.layouts.base', [
            'title' => 'Home - My Awesome App' // Kirim data ke layout
        ]);;
    }
}
