<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //Load helpers
        $this->loadHelpers();
    }

    protected function loadHelpers()
    {
        $helpers = $this->app['files']->glob(__DIR__ . '/../Helpers/*.php');
        foreach ($helpers as $helper) {
            require_once $helper;
        }
    }
}
