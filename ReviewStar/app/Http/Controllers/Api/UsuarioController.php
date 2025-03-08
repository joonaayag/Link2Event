<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\Usuario;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UsuarioController extends Controller
{
    public function index()
    {
        return response()->json(Usuario::all());
    }

    public function store(Request $request)
    {
        $user = Usuario::create($request->all());
        return response()->json($user, 201);
    }
}
