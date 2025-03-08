<?php

namespace App\Http\Controllers\Api;

use App\Models\Comentarios;
use App\Models\FavoriteEvent;
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

    public function listaComentarios()
    {
        $comentarios = Comentarios::all();

        if (!$comentarios) {
            return response()->json(['message' => 'No se encontraron comentarios'], 404);
        } else {
            return response()->json($comentarios);
        }
    }

    public function comentariosUsuario($id_usuario)
    {
        $comentarios = Comentarios::where('id_usuario', $id_usuario)->get();

        if (count($comentarios) == 0) {
            return response()->json(['message' => 'Este usuario no tiene comentarios'], 404);
        } else {
            return response()->json($comentarios);
        }
    }

    public function comentarioId($id_comentario)
    {
        $comentario = Comentarios::find($id_comentario);

        if (!$comentario) {
            return response()->json(['message' => 'No existe comentario con ID introducido'], 404);
        } else {
            return response()->json($comentario);
        }
    }

    //Esta funcion devuelve los comentarios que contienen el parámetro introducido
    public function comentarioContenido($contenido)
    {
        $comentarios = Comentarios::where('comentario', 'like', '%' . $contenido . '%')->get();

        if (count($comentarios) == 0) {
            return response()->json(['message' => 'No se encontraron comentarios con ese contenido'], 404);
        } else {
            return response()->json($comentarios);
        }
    }


    public function listaFavoritos(){
        $favoritos = FavoriteEvent::all();

        if (!$favoritos) {
            return response()->json(['message' => 'No se encontraron favoritos'], 404);
        } else {
            return response()->json($favoritos);
        }
    }

    public function listaFavoritosUsuario($id_usuario){
        $favoritos = FavoriteEvent::where('user_id', $id_usuario)->get();

        if (count($favoritos) == 0) {
            return response()->json(['message' => 'Este usuario no tiene favoritos'], 404);
        } else {
            return response()->json($favoritos);
        }
    }


    public function favoritosId($id_favoritos){
        $favorito = FavoriteEvent::find($id_favoritos);

        if (!$favorito) {
            return response()->json(['message' => 'No existe favorito con ID introducido'], 404);
        } else {
            return response()->json($favorito);
        }
    }

    public function favoritosIDEvento($id_eventos){
        $favoritos = FavoriteEvent::where('event_id', $id_eventos)->get();

        if (count($favoritos) == 0) {
            return response()->json(['message' => 'El ID de evento introducido no figura en la lista de favoritos'], 404);
        } else {
            return response()->json($favoritos);
        }
    }

    public function favoritosIDEventoIDUsuario($id_evento, $id_usuario){

        $favoritos = FavoriteEvent::where('event_id', $id_evento)->where('user_id', $id_usuario)->get();
        if (count($favoritos) > 0) {
            return response()->json($favoritos);
        } else {
            return response()->json(['message' => 'No hay eventos encontrados que coincidan con el ID introducido y usuario introducido'], 404);
        }
    }

    public function listaFavoritosNombre($nombre_evento){
        $favoritos = FavoriteEvent::where('event_name', 'like', '%' . $nombre_evento . '%')->get();

        if (count($favoritos) == 0) {
            return response()->json(['message' => 'El nombre de evento introducido no figura en la lista de favoritos'], 404);
        } else {
            return response()->json($favoritos);
        }
    }

    public function listaFavoritosCiudad($ciudad){
        $favoritos = FavoriteEvent::where('event_city', 'like', '%' . $ciudad . '%')->get();

        if (count($favoritos) == 0) {
            return response()->json(['message' => 'No hay eventos en la ciudad introducida que estén en la lista de favoritos'], 404);
        } else {
            return response()->json($favoritos);
        }
    }
    public function listaFavoritosGenero($genero){
        $favoritos = FavoriteEvent::where('event_genre', 'like', '%' . $genero . '%')->get();

        if (count($favoritos) == 0) {
            return response()->json(['message' => 'No hay eventos en con este género que estén en la lista de favoritos'], 404);
        } else {
            return response()->json($favoritos);
        }
    }


}
