<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use BezhanSalleh\FilamentShield\Traits\HasPageShield;

class ParticipantDashboard extends Page
{
    use HasPageShield;
    protected static ?string $navigationIcon = 'heroicon-o-home';

    protected static string $view = 'filament.pages.participant-dashboard';
    protected static ?string $navigationLabel = 'Halaman Utama';
    protected static ?string $navigationGroup='Home';
}
