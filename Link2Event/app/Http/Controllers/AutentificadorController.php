<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class AutentificadorController extends Controller
{
    public function registrar(Request $request)
    {
        // Validar los datos del formulario
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

        // dependiendo de qué seleccione el usuario tiene una validación u otra
        if ($request->tipo_identificacion == 'NIF') {
            if (!preg_match('/^[XYZ]?\d{5,8}[A-Z]$/', $request->num_identificacion)) {
                return redirect()->back()->withErrors(['num_identificacion' => 'El NIF debe tener el formato correcto: [XYZ]-XXXXXXXX-A o XXXXXXXX-A'])->withInput();
            }
        } elseif ($request->tipo_identificacion == 'DNI') {
            if (!preg_match('/^\d{8}[A-Z]$/', $request->num_identificacion)) {
                return redirect()->back()->withErrors(['num_identificacion' => 'El DNI debe tener el formato correcto: XXXXXXXX-A'])->withInput();
            }
        }


        // Crear y guardar el usuario en la base de datos
        $usuario = Usuario::create([
            'nombre' => $request->nombre,
            'apellidos' => $request->apellidos,
            'edad' => $request->edad,
            'pais' => $request->pais,
            'tipo_identificacion' => $request->tipo_identificacion,
            'num_identificacion' => $request->num_identificacion,
            'direccion' => $request->direccion,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Encripta la contraseña
        ]);

        //Guardo el usuario en la base de datos.
        $usuario->save();

        // Redirigir con mensaje de éxito
        return redirect()->route('login')->with('success', 'Registro del usuario ' . $request->nombre . ' exitoso.');
    }

    public function iniciarSesion(Request $request)
    {
        $recordar = $request->has('recordar');


        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);


        $credenciales = $request->only('email', 'password');

        if (Auth::attempt($credenciales, $recordar)) {
            $request->session()->regenerate();

            if (!$recordar) {
                session()->put('expire_on_close', true);
            } else {
                session()->put('expire_on_close', false);
            }

            return redirect()->route('inicio')->with('success', '¡Hola ' . Auth::user()->nombre . '! Bienvenido a la página principal');
        }

        if (Usuario::where('email', $request->email)->exists()) {
            return back()->withErrors([
                'password' => 'La contraseña proporcionada no es válida.',
            ]);
        } else {
            return back()->withErrors([
                'email' => 'Credenciales no encontradas.',
                'password' => ' ',
            ]);
        }
    }

    public function cerrarSesion(Request $request)
    {
        Auth::logout();
        // Elimina los datos de la sesión
        $request->session()->invalidate();
        // Genera un nuevo token CSRF para que las siguientes solicitudes sean seguras (cambia el token)
        $request->session()->regenerateToken();
        return redirect()->route('bienvenida');
    }



}