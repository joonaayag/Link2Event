<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AutentificadorController;
use App\Http\Controllers\comentariosController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FavoriteEventController;

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

    // Rutas para favoritos
    Route::get('/favoritos', [FavoriteEventController::class, 'index'])->name('favoritos.index');
    Route::post('/favorites', [FavoriteEventController::class, 'store'])->name('favorites.store');
    Route::delete('/favorites', [FavoriteEventController::class, 'destroy'])->name('favorites.destroy');
    Route::get('/favorites/check', [FavoriteEventController::class, 'check'])->name('favorites.check');


    Route::get('/logout', [AutentificadorController::class, 'cerrarSesion'])->name('logout');

    Route::get('/admin/panel', [AdminController::class, 'adminPanel'])->name('admin.panel');//ruta para ver el panel
    
    // Solución error en editar usuario admin
    Route::get('/admin/editarUsuario', [AdminController::class, 'editarUsuario'])->name('editarUsuario.get');

    // ------------- RUTAS POST -------------
    Route::post('/perfil', [UserController::class, 'actualizarPerfil'])->name('perfil.actualizar');

    Route::delete('admin/eliminarUsuario', [AdminController::class, 'eliminarUsuario'])->name('eliminarUsuario'); //Ruta para eliminar usuario pulsando el botón
    Route::delete('/admin/eliminarComentario', [AdminController::class, 'eliminarComentario'])->name('eliminarComentario');
    Route::post('/admin/editarUsuario', [AdminController::class, 'editarUsuario'])->name('editarUsuario');
    Route::post('/admin/panel', [AdminController::class, 'adminPanel'])->name('admin.panel');//ruta para ver el panel después de haber enviado el formulario
    Route::post('/admin/mostrarComentariosUsuario', [AdminController::class, 'mostrarComentarios'])->name('mostrarComentarios');
    Route::get('/admin/mostrarComentariosUsuario', [AdminController::class, 'mostrarComentarios'])->name('mostrarComentarios');

    Route::post('/contactanos', [comentariosController::class, 'almacenarComentario'])->name('enviarComentario');
    Route::post('/admin/editar/perfil', [AdminController::class, 'editarPerfilUsuario'])->name('editarPerfilUsuario');
});