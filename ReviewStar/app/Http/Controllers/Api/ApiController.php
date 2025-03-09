<?php

namespace App\Http\Controllers\Api;

use App\Models\Comentario;
use App\Models\FavoriteEvent;
use App\Models\User;
use App\Models\Usuario;
use Hash;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;

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

    public function listaComentarios()
    {
        $comentarios = Comentario::all();

        if (!$comentarios) {
            return response()->json(['message' => 'No se encontraron comentarios'], 404);
        } else {
            return response()->json($comentarios);
        }
    }

    public function comentariosUsuario($id_usuario)
    {
        $comentarios = Comentario::where('id_usuario', $id_usuario)->get();

        if (count($comentarios) == 0) {
            return response()->json(['message' => 'Este usuario no tiene comentarios'], 404);
        } else {
            return response()->json($comentarios);
        }
    }

    public function comentarioId($id_comentario)
    {
        $comentario = Comentario::find($id_comentario);

        if (!$comentario) {
            return response()->json(['message' => 'No existe comentario con ID introducido'], 404);
        } else {
            return response()->json($comentario);
        }
    }

    //Esta funcion devuelve los comentarios que contienen el parámetro introducido
    public function comentarioContenido($contenido)
    {
        $comentarios = Comentario::where('comentario', 'like', '%' . $contenido . '%')->get();

        if (count($comentarios) == 0) {
            return response()->json(['message' => 'No se encontraron comentarios con ese contenido'], 404);
        } else {
            return response()->json($comentarios);
        }
    }


    public function listaFavoritos()
    {
        $favoritos = FavoriteEvent::all();

        if (!$favoritos) {
            return response()->json(['message' => 'No se encontraron favoritos'], 404);
        } else {
            return response()->json($favoritos);
        }
    }

    public function listaFavoritosUsuario($id_usuario)
    {
        $favoritos = FavoriteEvent::where('user_id', $id_usuario)->get();

        if (count($favoritos) == 0) {
            return response()->json(['message' => 'Este usuario no tiene favoritos'], 404);
        } else {
            return response()->json($favoritos);
        }
    }


    public function favoritosId($id_favoritos)
    {
        $favorito = FavoriteEvent::find($id_favoritos);

        if (!$favorito) {
            return response()->json(['message' => 'No existe favorito con ID introducido'], 404);
        } else {
            return response()->json($favorito);
        }
    }

    public function favoritosIDEvento($id_eventos)
    {
        $favoritos = FavoriteEvent::where('event_id', $id_eventos)->get();

        if (count($favoritos) == 0) {
            return response()->json(['message' => 'El ID de evento introducido no figura en la lista de favoritos'], 404);
        } else {
            return response()->json($favoritos);
        }
    }

    public function favoritosIDEventoIDUsuario($id_evento, $id_usuario)
    {

        $favoritos = FavoriteEvent::where('event_id', $id_evento)->where('user_id', $id_usuario)->get();
        if (count($favoritos) > 0) {
            return response()->json($favoritos);
        } else {
            return response()->json(['message' => 'No hay eventos encontrados que coincidan con el ID introducido y usuario introducido'], 404);
        }
    }

    public function listaFavoritosNombre($nombre_evento)
    {
        $favoritos = FavoriteEvent::where('event_name', 'like', '%' . $nombre_evento . '%')->get();

        if (count($favoritos) == 0) {
            return response()->json(['message' => 'El nombre de evento introducido no figura en la lista de favoritos'], 404);
        } else {
            return response()->json($favoritos);
        }
    }

    public function listaFavoritosCiudad($ciudad)
    {
        $favoritos = FavoriteEvent::where('event_city', 'like', '%' . $ciudad . '%')->get();

        if (count($favoritos) == 0) {
            return response()->json(['message' => 'No hay eventos en la ciudad introducida que estén en la lista de favoritos'], 404);
        } else {
            return response()->json($favoritos);
        }
    }
    public function listaFavoritosGenero($genero)
    {
        $favoritos = FavoriteEvent::where('event_genre', 'like', '%' . $genero . '%')->get();

        if (count($favoritos) == 0) {
            return response()->json(['message' => 'No hay eventos en con este género que estén en la lista de favoritos'], 404);
        } else {
            return response()->json($favoritos);
        }
    }

    public function crearUsuario(Request $request)
    {
        if (!$request->isJson()) {
            return response()->json(['error' => 'El formato esperado no es JSON'], 422);
        }
        //Laravel arroja una excepción automáticamente si la validación falla,
        try {
            $request->validate([
                'nombre' => 'required|string|max:15',
                'apellidos' => 'required|string|max:30',
                'edad' => 'required|integer|min:18|max:120',
                'pais' => 'required|string|max:30',
                'tipo_identificacion' => 'required|in:NIF,DNI',
                'num_identificacion' => 'required|string|max:9',
                'direccion' => 'required|string|max:100',
                'email' => 'required|string|email|max:50|unique:usuarios',
                'foto_perfil' => 'nullable|string',
                'password' => 'required|string|min:6|confirmed'
            ]);
        } catch (ValidationException $e) {
            return response()->json(['error' => 'Los datos introducidos no son correctos', 'detalles' => $e->errors()], 400);
        }

        $usuario = new Usuario();
        $usuario->nombre = $request->input('nombre');
        $usuario->apellidos = $request->input('apellidos');
        $usuario->edad = $request->input('edad');
        $usuario->pais = $request->input('pais');
        $usuario->tipo_identificacion = $request->input('tipo_identificacion');
        $usuario->num_identificacion = $request->input('num_identificacion');
        $usuario->direccion = $request->input('direccion');
        $usuario->email = $request->input('email');
        $usuario->foto_perfil = $request->input('foto_perfil');
        $usuario->password = Hash::make($request->input('password'));
        $usuario->save();

        return response()->json(['message' => 'Usuario creado correctamente'], 200);
    }

    public function crearComentario(Request $request, $id_usuario)
    {
        if (!$request->isJson()) {
            return response()->json(['error' => 'El formato esperado no es JSON'], 422);
        }
        $usuario = Usuario::find($id_usuario);

        if (!$usuario) {
            return response()->json(['error' => 'El usuario no existe, no se puede crear el comentario'], 404);
        }
        //Laravel arroja una excepción automáticamente si la validación falla,
        try {
            $request->validate([
                'comentario' => 'required|string',
            ]);
        } catch (ValidationException $e) {
            return response()->json(['error' => 'Los datos introducidos no son correctos', 'detalles' => $e->errors()], 400);
        }

        $comentario = new Comentario();
        $comentario->id_usuario = $usuario->id;
        $comentario->nombre_usuario = $usuario->nombre;
        $comentario->email_usuario = $usuario->email;
        $comentario->comentario = $request->input('comentario');
        $comentario->save();

        return response()->json(['message' => 'Comentario creado correctamente'], 200);
    }


    public function actualizarUsuario(Request $request, $id_usuario)
    {
        if (!$request->isJson()) {
            return response()->json(['error' => 'El formato esperado no es JSON'], 422);
        }
        $usuario = Usuario::find($id_usuario);

        if (!$usuario) {
            return response()->json(['error' => 'El usuario no existe, no se puede modificar el usuario'], 404);
        }
        //Laravel arroja una excepción automáticamente si la validación falla,
        try {
            $request->validate([
                'nombre' => 'required|string|max:15',
                'apellidos' => 'required|string|max:30',
                'edad' => 'required|integer|min:18|max:120',
                'pais' => 'required|string|max:30',
                'tipo_identificacion' => 'required|in:NIF,DNI',
                'num_identificacion' => 'required|string|max:9',
                'direccion' => 'required|string|max:100',
                'email' => 'required|string|email|max:50|unique:usuarios',
                'foto_perfil' => 'nullable|string',
            ]);
        } catch (ValidationException $e) {
            return response()->json(['error' => 'Los datos introducidos no son correctos', 'detalles' => $e->errors()], 400);
        }

        $usuario->nombre = $request->input('nombre');
        $usuario->apellidos = $request->input('apellidos');
        $usuario->edad = $request->input('edad');
        $usuario->pais = $request->input('pais');
        $usuario->tipo_identificacion = $request->input('tipo_identificacion');
        $usuario->num_identificacion = $request->input('num_identificacion');
        $usuario->direccion = $request->input('direccion');
        $usuario->email = $request->input('email');
        $usuario->foto_perfil = $request->input('foto_perfil');

        $usuario->save();

        return response()->json(['message' => 'Usuario modificado correctamente'], 200);
    }

    public function actualizarComentario(Request $request, $id_comentario, $id_usuario)
    {
        if (!$request->isJson()) {
            return response()->json(['error' => 'El formato esperado no es JSON'], 422);
        }
        $usuario = Usuario::find($id_usuario);
        $comentario = Comentario::find($id_comentario)->where('id_usuario', $id_usuario)->first();

        if (!$usuario) {
            return response()->json(['error' => 'El usuario no existe, no se puede actualizar el comentario'], 404);
        }
        if (!$comentario) {
            return response()->json(['error' => 'El comentario no existe o no esta asociado con dicho usuario, no se puede actualizar el comentario'], 404);
        }
        //Laravel arroja una excepción automáticamente si la validación falla,
        try {
            $request->validate([
                'comentario' => 'required|string',
            ]);
        } catch (ValidationException $e) {
            return response()->json(['error' => 'Los datos introducidos no son correctos', 'detalles' => $e->errors()], 400);
        }

        $comentario->comentario = $request->input('comentario');
        $comentario->save();

        return response()->json(['message' => 'Comentario modificado correctamente'], 200);
    }

    public function eliminarUsuario($id){
        $usuario = Usuario::find($id);
        if (!$usuario) {
            return response()->json(['error'=> 'ID de usuario no encontrado'],404);
        }

        Usuario::destroy($id);
        return response()->json('Usuario eliminado correctamente',200);

    }
    public function eliminarComentario($id){
        $comentario = Comentario::find($id);
        if (!$comentario) {
            return response()->json(['error'=> 'ID de comentario no encontrado'],404);
        }

        Comentario::destroy($id);
        return response()->json('Comentario eliminado correctamente',200);

    }   

}
