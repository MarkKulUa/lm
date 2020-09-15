<?php

namespace Tests;

use Illuminate\Contracts\Console\Kernel;
use Illuminate\Support\Facades\Artisan;

trait CreatesApplication
{
    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        return self::initialize();
    }

    private static $configurationApp = null;

    public static function initialize(){

        if(null === self::$configurationApp){
            $app = require __DIR__.'/../bootstrap/app.php';

            $app->make(Kernel::class)->bootstrap();

            $app->loadEnvironmentFrom('.env.testing');

            Artisan::call('migrate:refresh');
            Artisan::call('db:seed');

            self::$configurationApp = $app;
            return $app;
        }

        return self::$configurationApp;
    }
//
//    public function tearDown()
//    {
//        if ($this->app) {
//            foreach ($this->beforeApplicationDestroyedCallbacks as $callback) {
//                call_user_func($callback);
//            }
//
//        }
//
//        $this->setUpHasRun = false;
//
//        if (property_exists($this, 'serverVariables')) {
//            $this->serverVariables = [];
//        }
//
//        if (class_exists('Mockery')) {
//            \Mockery::close();
//        }
//
//        $this->afterApplicationCreatedCallbacks = [];
//        $this->beforeApplicationDestroyedCallbacks = [];
//    }
}
