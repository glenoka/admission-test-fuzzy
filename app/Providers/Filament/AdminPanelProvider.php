<?php

namespace App\Providers\Filament;

use Filament\Pages;
use Filament\Panel;
use Filament\Widgets;
use Filament\PanelProvider;
use App\Livewire\RegisterPage;
use App\Filament\Auth\Register;
use Filament\Support\Colors\Color;
use Illuminate\Support\Facades\Auth;
use App\Filament\Pages\Auth\RegisterCustom;
use Illuminate\Support\Facades\Route;
use App\Filament\Pages\Auth\LoginCustom;
use App\Filament\Pages\Auth\RegisterCustom as AuthRegisterCustom;
use Filament\Http\Middleware\Authenticate;
use App\Filament\Widgets\ParticipantOverview;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Filament\Http\Middleware\AuthenticateSession;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login(LoginCustom::class)
            ->registration()
            //->registration(RegisterCustom::class)
            ->colors([
                'primary' => '#f54900',
            ])
            ->brandLogo('/images/logo_pemkab.png')
             ->brandLogoHeight(fn() => Auth::check() ? '3rem' : '6rem')
            
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
               

            ])
            // ->routes(function () {
            //     Route::get('/register/{formation}', Register::class)->name('register');
            // })
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
                ParticipantOverview::class,
                
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
           
            ->plugins([
                \BezhanSalleh\FilamentShield\FilamentShieldPlugin::make(),
            ]);
    }
}
