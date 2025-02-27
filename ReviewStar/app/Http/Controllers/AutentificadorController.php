<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class AutentificadorController extends Controller
{
    public function registrar(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'edad' => 'required|integer|min:18',
            'nacionalidad' => 'required|string|max:255',
            'tipo_identificacion' => 'required|in:NIF,DNI',
            'num_identificacion' => 'required|string|max:255|unique:users',
            'direccion' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed'
        ]);

        // Crear y guardar el usuario en la base de datos
        $usuario = User::create([
            'nombre' => $request->nombre,
            'apellidos' => $request->apellidos,
            'edad' => $request->edad,
            'nacionalidad' => $request->nacionalidad,
            'tipo_identificacion' => $request->tipo_identificacion,
            'num_identificacion' => $request->num_identificacion,
            'direccion' => $request->direccion,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Encripta la contraseña
        ]);

        //Guardo el usuario en la base de datos.
        $usuario->save();

        // Redirigir con mensaje de éxito
        return redirect()->route('login')->with('success', 'Registro exitoso. Inicia sesión.');
    }

    public function iniciarSesion(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Intentar autenticar al usuario
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            // La autenticación fue exitosa
            return redirect()->route('base');
        }

        // Si las credenciales son incorrectas
        return back()->withErrors([
            'email' => 'Las credenciales proporcionadas son incorrectas.',
        ]);
    }
}