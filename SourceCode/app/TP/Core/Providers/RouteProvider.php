<?php
/**
 * Created by PhpStorm.
 * Users: phamt
 * Date: 8/7/2016
 * Time: 10:56 AM
 */

namespace App\TP\Core\Providers;


use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Routing\Router;

class RouteProvider extends ServiceProvider
{
    /**
     * This namespace is applied to the controller routes in your routes file.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\App3s\Core\Http\Controllers';

    /**
     * Define the routes for the application.
     *
     * @param \Illuminate\Routing\Router $router
     *
     * @return void
     */
    public function map(Router $router)
    {
        $router->group(['namespace' => $this->namespace], function (Router $router) {
            /*
             * Admin routes
             */
            //$router->get('admin/_locale/{locale}', 'LocaleController@setContentLocale')->name('admin::change-locale');
        });
    }
}
