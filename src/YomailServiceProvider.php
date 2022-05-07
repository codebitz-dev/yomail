<?php

namespace Codebitz\Yomail;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Mail;
use Codebitz\Yomail\YoMailTransporter;
use Illuminate\Mail\Events\MessageSending;
use Codebitz\Yomail\Listeners\YoMailListener;
use Codebitz\Yomail\Providers\MessageServiceProvider;
use Config;

class YomailServiceProvider extends ServiceProvider
{

    protected $commands = [
        'Codebitz\Yomail\Commands\YoMailInstall',
    ];

    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        /*
         * Optional methods to load your package assets
         */

        if(!Config::get('yomail.enabled')){
            return;
        }

        $this->loadViewsFrom(__DIR__.'/../resources/views', 'yomail');
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        $this->loadRoutesFrom(__DIR__.'/routes.php');



        if ($this->app->runningInConsole()) {

            $this->publishes([
                __DIR__.'/../config/config.php' => config_path('yomail.php'),
            ], 'yomailconfig');


            $this->publishes([
                __DIR__.'/../public' => public_path('vendor/yomail'),
            ], 'yomailassets');


            $this->commands($this->commands);
        }




    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'yomail');

        $this->app->register(MessageServiceProvider::class);



        // Register the main class to use with the facade
        $this->app->singleton('yomail', function () {
            return new Yomail;
        });
    }
}
