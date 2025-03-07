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

        $usuario = Auth::user();

        $fotoPerfil = $usuario->foto_perfil ? $usuario->foto_perfil : url('assets/img/foto-default.png'); 

        Comentarios::create([
            'id_usuario' => $usuario->id,
            'nombre_usuario' => $usuario->nombre,
            'email_usuario' => $usuario->email,
            'foto_perfil' => $fotoPerfil,
            'comentario' => $request->comentario,
        ]);

        return redirect()->back()->with('success', 'Comentario enviado al administrador correctamente');
    }


}