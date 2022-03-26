<?php

namespace App\Providers;

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
        //
        view()->share('tipodocumentos', [
            'dni'=>'DNI',
            'carnet'=>'CARNET DE EXTRANJERIA',
            'ruc'=>'RUC',
            'pasaporte'=>'PASAPORTE',
            'otros'=>'OTROS'
        ]);
    }
}
