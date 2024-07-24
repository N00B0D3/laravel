<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

route::post('/register', function(Request $request){
    $request->validate([
        'email' => 'required|string|email|unique:users',
        'nome' => 'required|string',
        'password' => 'required|string|min:6'
    ]);
});
 
Route::post('/login', function (Request $request) {
    $crendentials = $request->only('email', 'password');
    
    if(Auth::attempt([$crendentials])){
        $user = $request->user();
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer'
        ]);
    }

    return response()->json([
        'mensage' => 'Usuario invalido',
    ]);

    $token = $request->user()->createToken($request->token_name);
 
    return ['token' => $token->plainTextToken];
});



Route::get('/user/dashboard', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
