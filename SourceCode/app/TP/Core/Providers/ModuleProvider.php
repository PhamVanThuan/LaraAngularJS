<?php

/**
 * Created by PhpStorm.
 * Users: phamt
 * Date: 8/7/2016
 * Time: 10:55 AM
 */
namespace App\TP\Core\Providers;

use Exception;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;

class ModuleProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views/', 'core');

        // translations
        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'core');

    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $app = $this->app;

        /*
         * Register route service provider
         */
        $app->register(\App\App3s\Core\Providers\RouteProvider::class);

        /*
        |--------------------------------------------------------------------------
        | Init list of modules.
        |--------------------------------------------------------------------------
        */
        Config::set('app3s.modules', []);

        /*
        |--------------------------------------------------------------------------
        | TypiCMS utilities.
        |--------------------------------------------------------------------------
        */
        $this->app->singleton('app3s', function () {

        });
        /*
        |--------------------------------------------------------------------------
        | View composers.
        |--------------------------------------------------------------------------
        */
        $app->view->composers([
            //MasterViewComposer::class => '*',
            //LocaleComposer::class     => '*::public.*',
            //LocalesComposer::class    => '*::admin.*',
        ]);

        $this->registerCommands();
        $this->registerModuleRoutes();
        $this->registerCoreModules();
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }

    /**
     * Register artisan commands.
     *
     * @return void
     */
    private function registerCommands()
    {

    }

    /**
     * Get routes from pages.
     *
     * @return void
     */
    private function registerModuleRoutes()
    {
        $this->app->singleton('app3s.routes', function (Application $app) {
            try {
                //return $app->make(\TypiCMS\Modules\Pages\Repositories\PageInterface::class)->getForRoutes();
            } catch (Exception $e) {
                return [];
            }
        });
    }

    /**
     * Register core modules.
     *
     * @return void
     */
    protected function registerCoreModules()
    {
        $app = $this->app;
        $app->register(\App\App3s\Modules\Test\Providers\ModuleProvider::class);
        $app->register(\App\App3s\Modules\Users\Providers\ModuleProvider::class);
    }
}