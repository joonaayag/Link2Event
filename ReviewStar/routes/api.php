<?php

use App\Http\Controllers\Api\ApiController;
use App\Http\Controllers\AutentificadorController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


// //Rutas GET
// Route::get('/', [UserController::class, 'inicio'])->name('base');
// Route::get('/login', [UserController::class, 'login'])->name('login');
// Route::get('/registrarse', [UserController::class, 'registrarse'])->name('registrarse');


// //Rutas POST
// Route::post('/registrarse', [AutentificadorController::class, 'registrar'])->name('registrar');

// Route::post('/login', [AutentificadorController::class, 'iniciarSesion'])->name('login.post');


//Rutas guzzle
//Usuarios
Route::get('/usuarios', [ApiController::class, 'listaUsuarios']);
Route::get('/usuarios/id/{id}', [ApiController::class, 'usuario']);
Route::get('/usuarios/edad/{edad}', [ApiController::class, 'usuarioEdad']);
Route::get('/usuarios/edad/{edad}/pais/{pais}', [ApiController::class, 'usuarioEdadPais']);
Route::get('/usuarios/pais/{pais}', [ApiController::class, 'usuarioPais']);
Route::get('/usuarios/tipo_identificacion/{tipo_identificacion}', [ApiController::class, 'usuarioTipoIdentificacion']);
Route::get('/usuarios/num_identificacion/{num_identificacion}', [ApiController::class, 'usuarioNumeroIdentificacion']);
Route::get('/usuarios/email/{email}', [ApiController::class, 'usuarioEmail']);
Route::get('/usuarios/rol/{rol}', [ApiController::class, 'usuarioRol']);
//Comentarios
Route::get('/comentarios', [ApiController::class,'listaComentarios']);
Route::get('/comentarios/{id_comentario}', [ApiController::class,'comentarioId']);
Route::get('/comentarios/usuario/{id_usuario}', [ApiController::class,'comentariosUsuario']);
Route::get('/comentarios/contenido/{mensaje}', [ApiController::class,'comentarioContenido']);
//Favoritos
Route::get('/favoritos', [ApiController::class,'listaFavoritos']);
Route::get('/favoritos/usuario/{id_usuario}', [ApiController::class,'listaFavoritosUsuario']);
Route::get('/favoritos/{id_favoritos}', [ApiController::class,'favoritosId']);
Route::get('/favoritos/evento/{id_eventos}', [ApiController::class,'favoritosIDEvento']);
Route::get('/favoritos/evento/{id_eventos}/usuario/{id_usuario}', [ApiController::class,'favoritosIDEventoIDUsuario']);
Route::get('/favoritos/evento/nombre/{nombre_evento}', [ApiController::class,'listaFavoritosNombre']);
Route::get('/favoritos/evento/ciudad/{ciudad}', [ApiController::class,'listaFavoritosCiudad']);
Route::get('/favoritos/evento/genero/{genero}', [ApiController::class,'listaFavoritosGenero']);