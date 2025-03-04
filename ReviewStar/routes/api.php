<?php

use App\Http\Controllers\AutentificadorController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


use App\Http\Controllers\ConciertoController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\EventosController;
use App\Models\Concierto;
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

Route::post('/conciertos', [SearchController::class, 'mostrarConciertos']);


Route::match(['GET', 'POST'], '/buscar', [SearchController::class, 'search'])->name('search');


//Rutas GET
Route::get('/', [UserController::class, 'inicio'])->name('base');
Route::get('/login', [UserController::class, 'login'])->name('login');
Route::get('/registrarse', [UserController::class, 'registrarse'])->name('registrarse');
Route::get('/eventos', [EventosController::class, 'index'])->name('eventos.index');
Route::get('/eventos/load-more', [EventosController::class, 'loadMoreEvents'])->name('eventos.load-more');


//Rutas POST
Route::post('/registrarse', [AutentificadorController::class, 'registrar'])->name('registrar');

Route::post('/login', [AutentificadorController::class, 'iniciarSesion'])->name('login.post');