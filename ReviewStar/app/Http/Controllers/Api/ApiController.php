<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\Usuario;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApiController extends Controller
{
    public function listaUsuarios()
    {
        $usuarios = Usuario::all();
        return response()->json($usuarios);
    }

public function usuario($id)
{
    $usuario = Usuario::find($id);
    if ($usuario) {
        return response()->json($usuario);
    } else {
        return response()->json(['message' => 'Usuario no encontrado'], 404);
    }
}

    public function usuarioEdad($edad)
    {
        $usuarios = Usuario::where('edad', $edad)->get();
        if ($usuarios) {
            return response()->json($usuarios);
        } else {
            return response()->json(['message' => 'Usuario no encontrado'], 404);
        }
    }
    public function usuarioEdadPais($edad, $pais)
    {
        $usuarios = Usuario::where('edad', $edad)->where('pais', $pais)->get();
        if ($usuarios) {
            return response()->json($usuarios);
        } else {
            return response()->json(['message' => 'Usuario no encontrado'], 404);
        }
    }

    public function usuarioPais($pais)
    {
        $usuarios = Usuario::where('pais', $pais)->get();
        if ($usuarios) {
            return response()->json($usuarios);
        } else {
            return response()->json(['message' => 'Usuario no encontrado'], 404);
        }
    }
    public function usuarioTipoIdentificacion($tipo_identificacion)
    {
        $usuarios = Usuario::where('tipo_identificacion', $tipo_identificacion)->get();
        if ($usuarios) {
            return response()->json($usuarios);
        } else {
            return response()->json(['message' => 'Usuario no encontrado'], 404);
        }
    }
    public function usuarioNumeroIdentificacion($num_identificacion)
    {
        $usuarios = Usuario::where('num_identificacion', $num_identificacion)->get();
        if ($usuarios) {
            return response()->json($usuarios);
        } else {
            return response()->json(['message' => 'Usuario no encontrado'], 404);
        }
    }
    public function usuarioEmail($email)
    {
        $usuarios = Usuario::where('email', $email)->get();
        if ($usuarios) {
            return response()->json($usuarios);
        } else {
            return response()->json(['message' => 'Usuario no encontrado'], 404);
        }
    }
    public function usuarioRol($rol)
    {
        $usuarios = Usuario::where('rol', $rol)->get();
        if ($usuarios) {
            return response()->json($usuarios);
        } else {
            return response()->json(['message' => 'Usuario no encontrado'], 404);
        }
    }
    

}
