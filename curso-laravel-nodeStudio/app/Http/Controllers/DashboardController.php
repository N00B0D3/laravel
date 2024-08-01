<?php

namespace App\Http\Controllers;
use App\Models\User;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){

        $usuarios = User::all()->count();

        return view('admin/dashboard', compact('usuarios'));
    }
}
