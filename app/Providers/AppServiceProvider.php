<?php

namespace App\Providers;

use Filament\Facades\Filament;
use Illuminate\Support\HtmlString;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $logo='logo.PNG';
        $manifest='/manifest.json';
        Filament::pushMeta([
            new HtmlString('<meta name="theme-color" content="#6777ef"/>'),
            new HtmlString('<link rel="apple-touch-icon" href="'.asset($logo).'" >'),
            new HtmlString('<link rel="manifest" href="'.asset($manifest).'">'),
        ]);
        Filament::registerScripts([
            asset('/sw.js'),
            asset('/extra.js'),
        ]);
    }
}
