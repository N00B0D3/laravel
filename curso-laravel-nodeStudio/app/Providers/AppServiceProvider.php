<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Categoria;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Gate;
use App\Models\produto;
use App\Models\user;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
{
    
    view::composer('*', function ($view) {

        $categoriasMenu = Categoria::all();
        $view->with('categoriasMenu', $categoriasMenu);

        $carrinho = Session::get('carrinho', []);
        $numeroDeItens = array_sum(array_column($carrinho, 'quantidade'));
        View::share('numeroDeItens', $numeroDeItens);
        
        Gate::define('ver-produto', function(User $user, Produto $produto){
            return $user->id === $produto->id;
        });
    });
}
}
