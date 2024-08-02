<?php

namespace App\Http\Controllers;
use Illuminate\Routing\Controllers\Middleware;
use App\Models\Produto;
use Illuminate\Support\Facades\Session;

use Illuminate\Http\Request;

class CarrinhoController extends Controller  
{

    public function carrinhoLista()
{
    $carrinho = Session::get('carrinho', []);
    $ids = array_keys($carrinho);
    $itens = Produto::whereIn('id', $ids)->get();
    $total = 0;

    foreach ($itens as $item) {
        $item->quantidade = $carrinho[$item->id]['quantidade'];
        $total += $item->valor * $item->quantidade;
    }

    return view('site/carrinho', compact('itens', 'total'));
}

public function adicionaCarrinho(Request $request)
{
    $id = $request->input('id');
    $quantidade = $request->input('quantidade', 1);
    $carrinho = Session::get('carrinho', []);

    $produto = Produto::find($id);
    if ($produto && $produto->quantidade >= $quantidade) {
        if (isset($carrinho[$id])) {
            $carrinho[$id]['quantidade'] += $quantidade;
        } else {
            $carrinho[$id] = [
                'id' => $id,
                'quantidade' => $quantidade
            ];
        }

        // Atualiza o estoque
        $produto->quantidade -= $quantidade;
        $produto->save();

        Session::put('carrinho', $carrinho);

        return redirect()->route('site/carrinho')->with('sucesso', 'Item adicionado ao carrinho.');
    } else {
        return redirect()->route('site/carrinho')->with('erro', 'Quantidade de estoque insuficiente.');
    }
}



public function atualizaQuantidade(Request $request)
{
    $id = $request->input('id');
    $quantidade = $request->input('quantidade');
    $carrinho = Session::get('carrinho', []);

    if (isset($carrinho[$id])) {
        $carrinho[$id]['quantidade'] = $quantidade;
        Session::put('carrinho', $carrinho);
    }

    return redirect()->route('site/carrinho');
}

public function removeCarrinho(Request $request)
{
    $id = $request->input('id'); //# recebendo o id do produto a ser removido
    $carrinho = Session::get('carrinho',[]); //# recebendo a sessão do usuario

    if(isset($carrinho[$id])){
        unset($carrinho[$id]); //# remove o item do carinho
        Session::put('carrinho', $carrinho); //# atualizando sessão
    }

    return redirect(route('site/carrinho'))->with('sucesso', 'item removido do carrinho com sucesso');

}

public function limparcarrinho()
{
    Session::forget('carrinho'); //# remove o carrinho da sessão

    return redirect(route('site/carrinho'))->with('aviso', 'seu carrinho está vazio');
}

    
}

