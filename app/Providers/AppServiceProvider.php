<?php

namespace App\Providers;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\URL;
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
        //если неправильно формируется УРЛ
        if (strpos(Config::get('app.url'), 'https://')) {
            URL::forceRootUrl(Config::get('app.url'));
            URL::forceScheme('https');
        }
    }
}
