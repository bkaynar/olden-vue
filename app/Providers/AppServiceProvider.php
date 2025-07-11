<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Inertia\Inertia;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        try {
            $ayar = DB::table('ayarlar')->select([
                'site_aciklama',
                'site_kelimeler',
                'logo',
                'telegram',
                'twitter',
                'instagram',
                'favicon'
            ])->first();

            $siteTitle      = $ayar->site_aciklama  ?? 'Altyapılı Dünyanın 1 Numaralı Bahis Sitesi';
            $siteKeywords   = $ayar->site_kelimeler ?? '';
            $siteLogo       = $ayar->logo           ?? '/images/logon.png';
            $telegramLink   = $ayar->telegram       ?? '#';
            $twitterLink    = $ayar->twitter        ?? '#';
            $instagramLink  = $ayar->instagram      ?? '#';
            $favicon        = $ayar->favicon        ?? '/favicon.ico';
        } catch (\Exception $ex) {
            $siteTitle      = 'Altyapılı Dünyanın 1 Numaralı Bahis Sitesi';
            $siteKeywords   = '';
            $siteLogo       = '/images/logon.png';
            $telegramLink   = '#';
            $twitterLink    = '#';
            $instagramLink  = '#';
            $favicon        = '/favicon.ico';
        }

        // Tüm view'lara global olarak paylaş
        View::share([
            'siteTitle' => $siteTitle,
            'siteKeywords' => $siteKeywords,
            'siteLogo' => $siteLogo,
            'telegramLink' => $telegramLink,
            'twitterLink' => $twitterLink,
            'instagramLink' => $instagramLink,
            'favicon' => $favicon,
        ]);

        // Inertia ile tüm Vue sayfalarına global olarak paylaş
        Inertia::share([
            'siteTitle' => $siteTitle,
            'siteKeywords' => $siteKeywords,
            'siteLogo' => $siteLogo,
            'telegramLink' => $telegramLink,
            'twitterLink' => $twitterLink,
            'instagramLink' => $instagramLink,
            'favicon' => $favicon,
        ]);
    }
}
