<?php

namespace App\Http\Controllers;

use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;


class UserController extends Controller
{
    
    public function inicio(){
        return view('layouts/base');
    }

    public function login(){
        return view('login');
    }

    public function registrarse(){
        return view('registrarse');
    }

    public function conciertos(){
        return view('conciertos');
    }

    public function perfil()
{
    return view('perfil');
}



public function editarPerfil(){
    return view('editar-perfil');
}

public function actualizarPerfil(Request $request)
{
    // Validar los datos del formulario
    $request->validate([
        'nombre' => 'required|string|max:255',
        'apellidos' => 'required|string|max:255',
        'edad' => 'required|integer|min:18',
        'nacionalidad' => 'required|string|max:255',
        'tipo_identificacion' => 'required|in:NIF,DNI',
        'direccion' => 'required|string|max:255',
        'email' => [
            'required',
            'email',//Verifica que sea unico en la tabla ignorando el usuario actual
            Rule::unique('users')->ignore(Auth::user()->id)],
        'password' => 'string|min:6|confirmed|nullable'
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
    $usuario->nacionalidad = $request->nacionalidad;
    $usuario->tipo_identificacion = $request->tipo_identificacion;
    $usuario->num_identificacion = $request->num_identificacion;
    $usuario->direccion = $request->direccion;
    $usuario->email = $request->email;
    
    if ($request->filled('password') && $request->password == $request->password_confirmation) {
        $usuario->password = Hash::make($request->password);
    }
    
    $usuario->save();
    
    return redirect()->route('perfil')->with('success', 'Perfil actualizado correctamente');
}

}
