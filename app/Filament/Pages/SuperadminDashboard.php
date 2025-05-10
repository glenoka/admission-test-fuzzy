<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\ParticipantOverview;
use BezhanSalleh\FilamentShield\Traits\HasPageShield;
use BezhanSalleh\FilamentShield\Traits\HasPanelShield;
use Filament\Pages\Page;

class SuperadminDashboard extends Page
{
    use HasPageShield;
    protected static ?string $navigationIcon = 'heroicon-o-home';

    protected static string $view = 'filament.pages.superadmin-dashboard';
    protected static ?string $navigationLabel = 'Halaman Utama';
    protected static ?string $navigationGroup='Home';
    protected static ?int $navigationSort = -2;
    public function data(){
        return ParticipantOverview::class;
    }
   
}
