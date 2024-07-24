<?php

namespace App\Http\Controllers;
use Illuminate\Routing\Controllers\Middleware;

use Illuminate\Http\Request;

class CarrinhoController extends Controller  
{
    public function __construct() {
        return new Middleware(middleware: 'auth');
    }
}
