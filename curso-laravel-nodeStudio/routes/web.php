<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\SiteController;


//Resource

route::resource('produtos', ProdutoController::class);

//produtos
Route::get('/', [SiteController::class, 'index'])->name('site/index');
route::get('/produto/{slug}', [SiteController::class, 'details'])->name('site/details');
Route::get('/categorias/{id}', [SiteController::class, 'categoria'])->name('site/categoria');

//login
route::view('/login', 'login/form')->name('login/form');
route::post('auth', [LoginController::class, 'auth'])->name('login/auth');
Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin/dashboard');

//logout
Route::get('/logout',[LoginController::class, 'logout'])->name('login/logout');



//Controllers

// Route::get('/', [ProdutoController::class, 'index'] );

//Passando parametros para o controller

// route::get('/produto/{id?}', [ProdutoController::class, 'show'])->name('produto.show');


//Grupos de rotas

//Por prefixo

// route::prefix('admin')->group(function(){
//     route::get('dashboard', function(){
//         return "dashboard";
//     });
    
//     route::get('users', function(){
//         return "users";
//     });
    
//     route::get('clientes', function(){
//         return "clientes";
//     });
// });

//Por nome

// route::name('admin.')->group(function(){
//     route::get('admin/dashboard', function(){
//         return "dashboard";
//     })->name('dashboard');

//     route::get('admin/users', function(){
//         return "users";
//     })->name('users');

//     route::get('admin/clientes', function(){
//         return "clientes";
//     })->name('clientes');
// });


//por grupo

// route::group([                           //quando se usa group, a chave para o "name" é o "as"
//     'prefix' => 'admin',
//     'as' => 'admin.'
// ], function(){
//     route::get('admin/dashboard', function(){
//         return "dashboard";
//     })->name('dashboard');

//     route::get('admin/users', function(){
//         return "users";
//     })->name('users');

//     route::get('admin/clientes', function(){
//         return "clientes";
//     })->name('clientes');
// });


//Rotas nomeadas

// route::get('/timesnownews', function(){
//     return view('news');
// })->name('noticias');

// route::get('/novidades', function(){
//     return redirect()->route('noticias');
// });


//adicionando parametros ao link http

// route::get('/produto/{id}/{cat}', function($id, $cat){   cat=categoria
//     return 'O id do produto é ' . $id. '!<br> A categoria é ' . $cat . '!';
// });


//redirecionamentos

//1º forma
// route::get('/sobre', function(){
//     return redirect('/empresa');
// });

//2º forma
// route::redirect('/sobre', 'empresa');

//3º forma
//route::redirect('/sobre', '/empresa');
//route::view('/empresa','site/empresa');


//rotas any e match

// route::any('/any', function(){
//     return 'Permite todo tipo de acesso http (put,delete,get,post)';
// });

// route::match(['get','post'],'/match', function(){
//     return 'Permite apenas acessos definidos';
// });