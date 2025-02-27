<?php

use App\Http\Controllers\AutentificadorController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


//Rutas GET
Route::get('/', [UserController::class, 'inicio'])->name('base');

Route::get('/login', [UserController::class, 'login'])->name('login');

Route::get('/registrarse', [UserController::class, 'registrarse'])->name('registrarse');

Route::get('/conciertos', [UserController::class,'conciertos'])->name('conciertos');


//Rutas POST
Route::post('/registrarse', [AutentificadorController::class, 'registrar'])->name('registrar');

Route::post('/login', [AutentificadorController::class, 'iniciarSesion'])->name('login.post');