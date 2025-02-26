@extends('layouts.base')

@section('titulo', '- Login')

@section('contenido')

<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h4 class="mb-0">Iniciar sesión</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('login') }}" method="POST">
                    @csrf

                    <!-- Email -->
                    <div class="mb-3">
                        <label for="email" class="form-label">Correo electrónico</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>

                    <!-- Contraseña -->
                    <div class="mb-3">
                        <label for="password" class="form-label">Contraseña</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>

                    <!-- Recordar sesión -->
                    <div class="form-check mb-3">
                        <input type="checkbox" class="form-check-input" id="remember" name="remember">
                        <label class="form-check-label" for="remember">Recordar sesión</label>
                    </div>

                    <!-- Botón de inicio de sesión -->
                    <button type="submit" class="btn btn-primary w-100">Iniciar sesión</button>

                    <!-- Enlace para registrar -->
                    <div class="mt-3 text-center">
                        <p>No tienes cuenta? <a href="{{ route('registrarse') }}">Regístrate</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection