<?php

namespace App\Providers\Filament;

use App\Filament\auth\Register;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class MemberPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('member')
            ->path('member')
            ->darkMode(false)
            ->login()
            ->registration(Register::class)
            ->passwordReset()
            ->emailVerification()
            //->profile()
            ->spa()
            ->profile(isSimple: false)
            ->brandLogo(asset('images/logo-easyPro-Horizontal.png'))
            ->brandLogoHeight('4rem')
            ->favicon(asset('images/favicon.ico'))
            ->colors([
                //'primary' => Color::'',
                'primary' => '#0597F2',
            ])
            ->discoverResources(in: app_path('Filament/Member/Resources'), for: 'App\\Filament\\Member\\Resources')
            ->discoverPages(in: app_path('Filament/Member/Pages'), for: 'App\\Filament\\Member\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Member/Widgets'), for: 'App\\Filament\\Member\\Widgets')
            ->widgets([
                //Widgets\AccountWidget::class,
               // Widgets\FilamentInfoWidget::class,
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
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
