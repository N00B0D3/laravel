<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function auth(Request $request) {

        //validate armazena todos os erros em uma variavel chamada errors
        $credenciais = $request->validate([
            'email' => ['required', 'email',],
            'password' => ['required'],
        ],
        //personalizando errors
        [
            'email.required' => 'O Email é obrigatório',
            'email.email' => 'O Email não é válido',
            'password.required' => 'A senha é obrigatório',

        ]
    );

    if(Auth::attempt($credenciais)) {
        $request->session()->regenerate();
        return redirect()->intended(route('admin/dashboard'));
    } else {
        return redirect()->back()->with('erro', 'Email ou senha inválido');
    }
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regeneratetoken();
        return redirect(route('site/index'));
    }
}