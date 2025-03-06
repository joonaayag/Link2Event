<?php

namespace App\Http\Controllers;

use App\Models\Comentarios;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    //Compruebo que el usuario sea admin
    public function adminPanel()
    {
        if (Auth::user()->rol !== 'ADMIN') {
            redirect()->route('inicio');
        }

        //Cojo todos los datos de los usuarios que no sean admin.
        $usuarios = Usuario::where('rol', '!=', 'ADMIN')->get();
        return view('panelAdministrador', compact('usuarios'));
    }

    public function eliminarUsuario(Request $request)
    {
        if (Auth::user()->rol !== 'ADMIN') {
            redirect()->route('inicio');
        }

        $id_usuario = $request->input('id_usuario');
        $usuario = Usuario::findOrFail($id_usuario);
        $usuario->delete();
        return redirect()->route('admin.panel');
    }

    public function editarUsuario(Request $request)
    {

        if (Auth::user()->rol !== 'ADMIN') {
            redirect()->route('inicio');
        }

        $id_usuario = $request->input('id_usuario');
        $usuario = Usuario::findOrFail($id_usuario);
        
        return view('editarUsuario', compact('usuario'));

    }

    public function mostrarComentarios(Request $request){

        if (Auth::user()->rol !== 'ADMIN') {
            redirect()->route('inicio');
        }

        $comentarios = Comentarios::where('id_usuario', $request->input('id_usuario'));
        return view('adminComentarios', compact('comentarios'));
    }

}
