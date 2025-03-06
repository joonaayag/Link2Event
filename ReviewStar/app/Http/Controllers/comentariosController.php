<?php

namespace App\Http\Controllers;

use App\Models\Comentarios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class comentariosController extends Controller
{
    public function vistaComentarios()
    {
        return view('comentarios');
    }

    public function almacenarComentario(Request $request)
    {
        $request->validate([
            'comentario' => 'required|string',
        ]);

        $user = Auth::user();

        $fotoPerfil = $user->foto_perfil ? $user->foto_perfil : 'foto-default.png'; 

        Comentarios::create([
            'id_usuario' => $user->id,
            'nombre_usuario' => $user->nombre,
            'email_usuario' => $user->email,
            'foto_perfil' => $fotoPerfil,
            'comentario' => $request->comentario,
        ]);

        return redirect()->back()->with('success', 'Texto enviado al administrador correctamente');
    }
}