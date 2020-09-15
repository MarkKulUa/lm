<?php

namespace App\Providers;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

use Laravel\Passport\Console\ClientCommand;
use Laravel\Passport\Console\InstallCommand;
use Laravel\Passport\Console\KeysCommand;
use Laravel\Passport\Passport;

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
//        if (strpos(Config::get('app.url'), 'https://')) {
//            URL::forceRootUrl(Config::get('app.url'));
//            URL::forceScheme('https');
//        }

        Schema::defaultStringLength(191);
        Passport::routes();

        /*ADD THIS LINES*/
        $this->commands([
                            InstallCommand::class,
                            ClientCommand::class,
                            KeysCommand::class,
                        ]);
    }
}
