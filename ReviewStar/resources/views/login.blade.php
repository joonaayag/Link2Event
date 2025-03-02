@extends('layouts.base')

@section('titulo', '- Login')

@section('claseBody', 'class=pagina-login')

@section('contenido')

<div class="container d-flex justify-content-center align-items-center fondito">
    <div class="col-md-6">
        <div class="card tarjeta-formulario">
            <div class="card-header">
                <h2 class="mb-0 negrita">Iniciar sesión</h2>
            </div>
            <div class="card-body">
                <form action="{{ route('iniciarSesion') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="form-label">Correo electrónico</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" required value="{{ old('email') }}">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Contraseña</label>
                        <div class="input-group">
                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required>
                            <button type="button" class="btn btn-outline-secondary" id="botonContraseña">
                                <i id="eyeIcon" class="fas fa-eye"></i>
                            </button>
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        </div>
                    </div>
                    <div class="form-check mb-3">
                        <input type="checkbox" class="form-check-input" id="recordar" name="recordar">
                        <label class="form-check-label" for="recordar">Recordar sesión</label>
                    </div>
                    <button type="submit" class="btn btn-primary w-100 btn-registro">Iniciar sesión</button>
                    <div class="mt-3 text-center">
                        <p>No tienes cuenta? <a href="{{ route('registrarse') }}" class="enlaceAmarillo">Regístrate</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

