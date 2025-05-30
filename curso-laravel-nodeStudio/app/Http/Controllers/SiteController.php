<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\View;



class SiteController extends Controller
{
    use AuthorizesRequests;

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

    public function details(Request $request, $slug): RedirectResponse|View
    {

        $produto = Produto::where('slug', $slug)->first();

        //Gate::authorize('ver-produto', $produto); //# usando gate para apenas o usuario que cadastrou o produto possa visualizar os detalhes do mesmo
        $this->authorize('verProduto', $produto); //fazendo o mesmo com policy

        //restrigindo acesso com allows,denies,can,cannot no controller

        // if ($request->user()->can('verProduto', $produto)) {
        //     return view('site.details', compact('produto'));
        // }

        if (Gate::allows('ver-produto', $produto)) {
            return view('site.details', compact('produto'));
        }

        // if(gate::denies('ver-produto', $produto))
        // {
        //     return redirect()->route('site/index');
        // }

        return redirect()->route('site.index');
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

    public function estoqueAtual($id)
    {
        $produto = Produto::find($id);

        if ($produto) {
            return response()->json([
                'quantidade' => $produto->quantidade
            ]);
        }

        return response()->json(['error' => 'Produto não encontrado'], 404);
    }

    public function store(Request $request)
    {
         // Validando dados de entrada
         $validatedData = $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'valor' => 'required|numeric',
            'quantidade' => 'required|integer',
            'ativo' => 'required|in:S,N',
            'slug' => 'required|string|unique:produtos|max:255',
        ]);

        // Criando produtos no DB
        $produto = Produto::create($validatedData);

        return response()->json($produto, 201);
    }

    public function show($id = 0)
    {
        $produto = Produto::find($id);

        if (!$produto) {
            return response()->json(['error' => 'Produto não encontrado'], 404);
        }

        return response()->json($produto, 200);
    }

    public function update(Request $request, $id)
    {
        $produto = Produto::find($id);

        if (!$produto) {
            return response()->json(['error' => 'Produto não encontrado'], 404);
        }

        // Validação dos dados de entrada
        $validatedData = $request->validate([
            'nome' => 'sometimes|required|string|max:255',
            'descricao' => 'sometimes|nullable|string',
            'valor' => 'sometimes|required|numeric',
            'quantidade' => 'sometimes|required|integer',
            'ativo' => 'sometimes|required|in:S,N',
        ]);

        // Atualiza o produto no banco de dados
        $produto->update($validatedData);

        return response()->json($produto, 200);
    }

    public function destroy($id)
    {
        $produto = Produto::find($id);

        if (!$produto) {
            return response()->json(['error' => 'Produto não encontrado'], 404);
        }

        $produto->delete();

        return response()->json(null, 204);
    }
}
