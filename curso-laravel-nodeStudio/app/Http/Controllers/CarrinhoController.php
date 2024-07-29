<?php

namespace App\Http\Controllers;
use Illuminate\Routing\Controllers\Middleware;
use App\Models\Produto;
use Illuminate\Support\Facades\Session;

use Illuminate\Http\Request;

class CarrinhoController extends Controller  
{

    public function carrinhoLista(){
        
    $ids = Session::get('carrinho', []);
    $itens = Produto::whereIn('id', $ids)->get(); //# whereIn: É um método de consulta do Eloquent que permite buscar registros onde o valor de uma coluna está dentro de uma lista de valores especificada.

    return view('site/carrinho', compact('itens'));
    }

    public function adicionaCarrinho(Request $request)
    {
        $id = $request->input('id');
        $carrinho = Session::get('carrinho', []);

        if (!in_array($id, $carrinho)) {
            $carrinho[] = $id;
            Session::put('carrinho', $carrinho);
        }

        return redirect()->route('site/carrinho');
    }
    
}

