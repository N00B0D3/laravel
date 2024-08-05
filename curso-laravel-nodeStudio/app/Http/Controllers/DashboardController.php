<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Categoria;
use App\Models\Produto;
use Illuminate\Support\Facades\DB;


use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){

        $usuarios = User::all()->count(); //ao usar all,where,find se usa o eloquent

        //gráfico 01 = usuarios
        $usersData = User::select([   //#tambem se pode usar select,update,delete etc
            DB::raw('YEAR(created_at) as ano'),
            DB::raw('COUNT(*) as total')
        ])
        ->groupBy('ano')
        ->orderBy('ano', 'asc')
        ->get();

        //preparar arrays
        foreach($usersData as $user){
            $ano[] = $user->ano;
            $total[] = $user->total;
        }

        //formatar para chart.js
        $userLabel = "'Comparativo de cadastros de usuários'";
        $userAno = implode(',', $ano);
        $userTotal = implode(',', $total);

        //gráfico 02 - categorias
        $catData = Categoria::with('produtos')->get();

        //preparar array
        foreach($catData as $cat){
            $catNome[] = "'" .  $cat->nome . "'";
            $catTotal[] = $cat->produtos->count();  //usando hasmany no model categoria
        }

        //formatar para chartjs
        $catLabel = implode(',', $catNome);
        $catTotal = implode(',', $catTotal);

        return view('admin/dashboard', compact('usuarios', 'userLabel', 'userAno', 'userTotal', 'catLabel', 'catTotal'));
    }
}
