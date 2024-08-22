<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;

class ProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //exibir produtos
        $produtos = Produto::paginate(3);
        return response()->json();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
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

    /**
     * Display the specified resource.
     */
    public function show($id = 0)
    {
        $produto = Produto::find($id);

        if (!$produto) {
            return response()->json(['error' => 'Produto não encontrado'], 404);
        }

        return response()->json($produto, 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
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

    /**
     * Remove the specified resource from storage.
     */
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
