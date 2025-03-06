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
            return redirect()->route('inicio');
        }

        //Cojo todos los datos de los usuarios que no sean admin.
        $usuarios = Usuario::where('rol', '!=', 'ADMIN')->get();
        
        return view('panelAdministrador', compact('usuarios'));
    }

    public function eliminarUsuario(Request $request)
    {
        if (Auth::user()->rol !== 'ADMIN') {
            return redirect()->route('inicio');
        }

        $id_usuario = $request->input('id_usuario');
        $usuario = Usuario::findOrFail($id_usuario);
        $usuario->delete();
        return redirect()->route('admin.panel');
    }

    //Muestra el formulario para editar el usuario
    public function editarUsuario(Request $request)
    {

        if (Auth::user()->rol !== 'ADMIN') {
            return redirect()->route('inicio');
        }

        $id_usuario = $request->input('id_usuario');
        
        $usuario = Usuario::findOrFail($id_usuario);
        
        return view('editarUsuario', compact('usuario'));

    }

    //Una vez enviado el formulario entra aquí
    public function editarPerfilUsuario(Request $request){
        $request->validate([
            'nombre' => 'required|string|max:15',
            'apellidos' => 'required|string|max:30',
            'edad' => 'required|integer|min:18|max:120',
            'pais' => 'required|string|max:30',
            'tipo_identificacion' => 'required|in:NIF,DNI',
            'num_identificacion' => 'required|string|max:9',
            'direccion' => 'required|string|max:100',
            'email' => 'required|string|email|max:50|unique:usuarios'
        ]);

        $usuario = Usuario::findOrFail($request->input('id_usuario'));

        $usuario->nombre = $request->input('nombre');
        $usuario->apellidos = $request->input('apellidos');
        $usuario->edad = $request->input('edad');
        $usuario->pais = $request->input('pais');
        $usuario->tipo_identificacion = $request->input('tipo_identificacion');
        $usuario->num_identificacion = $request->input('num_identificacion');
        $usuario->direccion = $request->input('direccion');
        $usuario->email = $request->input('email');

        $usuario->save();

        return redirect()->route('admin.panel').with('success', 'Perfil actualizado correctamente');
    }

    public function mostrarComentarios(Request $request){

        if (Auth::user()->rol !== 'ADMIN') {
            return redirect()->route('inicio');
        }
        $usuario = Usuario::findOrFail($request->input('id_usuario'));

        $comentarios = Comentarios::where('id_usuario', $request->input('id_usuario'))->get();
        return view('adminComentarios', compact('comentarios', 'usuario'));
    }
    
    public function eliminarComentario(Request $request){
        $comentario = Comentarios::findOrFail($request->id);
        $comentario->delete();
        return redirect()->back()->with('success', 'Comentario eliminado correctamente');
    }

}
