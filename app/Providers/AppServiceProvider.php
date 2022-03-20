<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;


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
        Paginator::useBootstrapFour();



        Blade::if('hasRole', function ($value) {
            return auth()->check() && (auth()->user()->hasRole($value) || auth()->user()->isSupperAdmin());
        });


        Blade::if('hasPermission', function ($value) {
            return auth()->check() && (auth()->user()->hasPermission($value) || auth()->user()->isSupperAdmin());
        });
    }
}
