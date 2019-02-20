<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use View;
use Illuminate\Support\Facades\Schema;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        $this->app->singleton('App\Singletons\Configuration', function () {
            return new \App\Singletons\Configuration();
        });


    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
