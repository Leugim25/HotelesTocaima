<?php

namespace App\Providers;

use App\CategoriaHotel;
use Illuminate\Support\ServiceProvider;
use View;

class CategoriasProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('*', function($view) {

            $categorias = CategoriaHotel::all();
            $view->with('categorias', $categorias);
        });
    }
}
