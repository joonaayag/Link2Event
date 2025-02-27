@extends('layouts.base')
@push('styles')
<style>
  body {
    background-image: url('{{ asset('assets/img/background-login.jpg') }}');
    background-size: cover;
    background-position: center;
    background-attachment: fixed;
  }
</style>
@endpush
@section('titulo', '- Login')

@section('contenido')

<div class="container d-flex justify-content-center align-items-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h4 class="mb-0">Iniciar sesión</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('login.post') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="form-label">Correo electrónico</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Contraseña</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <div class="form-check mb-3">
                        <input type="checkbox" class="form-check-input" id="recordar" name="recordar">
                        <label class="form-check-label" for="recordar">Recordar sesión</label>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Iniciar sesión</button>
                    <div class="mt-3 text-center">
                        <p>No tienes cuenta? <a href="{{ route('registrarse') }}">Regístrate</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection