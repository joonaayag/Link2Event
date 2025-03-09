<?php

namespace App\Http\Controllers;

use App\Models\Comentario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ComentariosController extends Controller
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

        Comentario::create([
            'id_usuario' => $usuario->id,
            'nombre_usuario' => $usuario->nombre,
            'email_usuario' => $usuario->email,
            'comentario' => $request->comentario,
        ]);

        return redirect()->back()->with('success', 'Comentario enviado al administrador correctamente');
    }


}