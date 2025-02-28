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
            'nombre' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'edad' => 'required|integer|min:18',
            'nacionalidad' => 'required|string|max:255',
            'tipo_identificacion' => 'required|in:NIF,DNI',
            'direccion' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:usuarios',
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
        $recordar = $request->has('recordar'); // Comprueba si el checkbox está marcado para mantener la sesión

        if (!$recordar) {
            config(['session.lifetime' => 2]); // Si no le ha dado a recordar se pone un tiempo de 2 minutos de sesión
        }

        // Validar los datos del formulario
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        // Intentar autenticar al usuario
        $credenciales = $request->only('email', 'password');
        
        if (Auth::attempt($credenciales, $recordar)) { // Si la autenticación fue exitosa
            //Inicio la sesión
            $request->session()->regenerate();
            return view('bienvenida');
        }

        // Si las credenciales son incorrectas
        return back()->withErrors([
            'email' => 'Las credenciales proporcionadas son incorrectas.',
        ]);
    }

    public function cerrarSesion(Request $request)
    {
        Auth::logout();
        // Elimina los datos de la sesión
        $request->session()->invalidate();
        // Genera un nuevo token CSRF para que las siguientes solicitudes sean seguras (cambia el token)
        $request->session()->regenerateToken();
        return redirect()->route('base');
    }
}
