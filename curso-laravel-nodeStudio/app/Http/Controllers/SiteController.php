<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use App\Models\Categoria;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function index()
    {
        $produtos = Produto::paginate(3);
        return view('site/home', compact('produtos'));

        //carrinho
        $registros = Produto::where([
            'ativo' => 'S',
        ])->get();

        return view('site/home', compact('registros'));
    }

    public function details($slug)
    {
        $produto = Produto::where('slug', $slug)->first();

        return view('site/details', compact('produto'));
    }

    public function categoria($id)
    {
        $categoria = Categoria::find($id);
        $produtos = Produto::where('id_categoria', $id)->paginate(3); /* pode se usar o get caso não necessite paginação */

        return view('site/categoria', compact('produtos', 'categoria'));
    }

    public function produto($id = null)
    {
        if( !empty($id) ) {
            $registro = Produto::where([
                'id' => $id,
                'Ativo' => 'S',
            ])->first();

        if( !empty($registro) ) {
            return view('site/details', compact('registro'));
        }
        };
        return redirect(route('site.home'));
    }
}
