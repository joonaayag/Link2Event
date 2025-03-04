<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
// use Storage;
use Illuminate\Support\Facades\Storage;


class UserController extends Controller
{

    public function bienvenida()
    {
        if (Auth::check()) { //Si ya estas logeado y tratas de entrar a /login
            return redirect('/conciertos');
        }

        return view('bienvenida');
    }

    public function inicio()
    {
        return view('inicio');
    }

    public function registrarse()
    {
        if (Auth::check()) { //Si ya estas logeado y tratas de entrar a /login
            return redirect('/conciertos');
        }

        return view('registrarse');
    }

    public function login()
    {
        if (Auth::check()) { //Si ya estas logeado y tratas de entrar a /login
            return redirect('/conciertos');
        }

        return view('login');
    }

    public function conciertos()
    {
        return view('conciertos');
    }

    public function perfil()
    {
        return view('perfil');
    }

    public function editarPerfil()
    {
        return view('editar-perfil');
    }

    public function actualizarPerfil(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'edad' => 'required|integer|min:18',
            'pais' => 'required|string|max:255',
            'tipo_identificacion' => 'required|in:NIF,DNI',
            'direccion' => 'required|string|max:255',
            'email' => [
                'required',
                'email', //Verifica que sea unico en la tabla ignorando el usuario actual
                Rule::unique('users')->ignore(Auth::user()->id)
            ],
            'password' => 'string|min:6|confirmed|nullable',
            'foto_perfil' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
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

        //Modifico los valores actuales por los nuevos ingresados en el formulario
        $usuario = Auth::user();
        $usuario->nombre = $request->nombre;
        $usuario->apellidos = $request->apellidos;
        $usuario->edad = $request->edad;
        $usuario->pais = $request->pais;
        $usuario->tipo_identificacion = $request->tipo_identificacion;
        $usuario->num_identificacion = $request->num_identificacion;
        $usuario->direccion = $request->direccion;
        $usuario->email = $request->email;

        if ($request->hasFile('foto_perfil')) {
            // // Borrar la foto anterior si existe
            if ($usuario->foto_perfil) {
                Storage::delete('perfiles/' . $usuario->foto_perfil);
            }

            // Guardar la nueva foto
            $imagen = $request->file('foto_perfil');
            if (!$imagen->isValid()) {
                echo "ERRRRRRRRRRRRRRRRRRRRR";
                return redirect()->back()->withErrors(['foto_perfil' => 'El archivo no es válido']);
            }
            $nombreImagen = time() . '.' . $imagen->getClientOriginalExtension();
            $imagen->storeAs('perfiles/', $nombreImagen);

            // Actualizar el usuario con la nueva foto
            $usuario->foto_perfil = $nombreImagen;
        }

        if ($request->filled('password') && $request->password == $request->password_confirmation) {
            // Actualizar la contraseña
            $usuario->password = Hash::make($request->password);
        }

        $usuario->save();

        return redirect()->route('perfil')->with('success', 'Perfil actualizado correctamente');
    }
}
