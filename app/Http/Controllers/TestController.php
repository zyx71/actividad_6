<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class TestController extends Controller
{
    public function index() {
    // Obtenemos todos los usuarios
    $users = User::all();
    
    // Pasamos los usuarios a la vista
    return view('test', compact('users'));
    }
}
