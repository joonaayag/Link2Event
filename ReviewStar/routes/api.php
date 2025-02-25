<?php

use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


//Rutas GET
Route::get('/', [UserController::class, 'inicio']);

Route::get('/login', [UserController::class, 'login'])->name('login');

Route::get('/registrar', [UserController::class, 'registrar'])->name('registrar');