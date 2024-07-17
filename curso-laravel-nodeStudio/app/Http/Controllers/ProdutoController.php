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
        //$produtos = Produto::all();
        //return dd($produtos);
        //return view('site/empresa') //para abrir views em pastas especificas, pode se usar "." no lugar da "/"
        //imprimindo dados na view
        $nome = 'Ruan';  
        $idade = 24;
        $frutas = ['banana', 'laranja', 'morango'];
        $html = "<h1>Olá eu sou h1</h1>";
        //return view('site/empresa', [ 'nome' => $nome, 'idade' =>$idade, 'html' =>$html]);
        return view('site/home', compact('nome', 'idade', 'html', 'frutas'));
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id = 0)
    {
        return "show: " .$id;
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
