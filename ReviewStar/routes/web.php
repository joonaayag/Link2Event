<?php

use App\Http\Controllers\AutentificadorController;
use App\Http\Controllers\comentariosController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


// ------------- RUTAS GET -------------//
Route::get('/', [UserController::class, 'bienvenida'])->name('bienvenida');
Route::get('/registrarse', [UserController::class, 'registrarse'])->name('registrarse');
Route::get('/login', [UserController::class, 'login'])->name('login');

// ------------- RUTAS POST -------------//
//Ruta formulario de registro
Route::post('/registro', [AutentificadorController::class, 'registrar'])->name('registrar');
Route::post('/login', [AutentificadorController::class, 'iniciarSesion'])->name('iniciarSesion');

//Ruta despues de haber iniciado sesión y haber entrado a la ruta iniciarSesion (al final mostramos la vista conciertos)
Route::post('/eventos', [UserController::class, 'eventos'])->name('eventos');




// ------------- RUTAS PROTEGIDAS -------------
//Rutas cuyo acceso necesita ser autentificado (si no estas autentificado no puedes acceder a estas rutas)
Route::middleware(['auth'])->group(function () {

    // ------------- RUTAS GET -------------
    Route::get('/eventos', [UserController::class, 'eventos'])->name('eventos');
    Route::get('/perfil', [UserController::class, 'perfil'])->name('perfil');
    Route::get('/perfil/editar', [UserController::class, 'editarPerfil'])->name('perfil.editar');
    Route::get('/inicio', [UserController::class, 'inicio'])->name('inicio');
    Route::get('/sobre_nosotros', [UserController::class, 'sobreNosotros'])->name('sobre_nosotros');
    Route::get('/contactanos', [UserController::class, 'contactanos'])->name('contactanos');

    Route::get('/logout', [AutentificadorController::class, 'cerrarSesion'])->name('logout');

    
    // ------------- RUTAS POST -------------
    Route::post('/perfil', [UserController::class, 'actualizarPerfil'])->name('perfil.actualizar');
    Route::post('/contactanos', [comentariosController::class, 'almacenarComentario'])->name('enviarComentario');
});