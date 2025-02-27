@extends('layouts.base')

@section('titulo', '- Registrarse')

@section('contenido')

    <div class="container d-flex justify-content-center align-items-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">Registrarse</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('registrarse') }}" method="POST">
                        @csrf
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="nombre" class="form-label">Nombre</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" required>
                            </div>
                            <div class="col-md-6">
                                <label for="apellidos" class="form-label">Apellidos</label>
                                <input type="text" class="form-control" id="apellidos" name="apellidos" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="edad" class="form-label">Edad</label>
                                <input type="number" class="form-control" id="edad" name="edad" required>

                            </div>
                            <div class="col-md-6">
                                <label for="nacionalidad" class="form-label">Nacionalidad</label>
                                <input type="text" class="form-control" id="nacionalidad" name="nacionalidad" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="tipo identificacion" class="form-label">Tipo de identificación</label>
                                <select name="tipo_identificacion" id="tipo_identificacion">
                                    <option value="DNI">DNI</option>
                                    <option value="NIE">NIE</option>
                                    <option value="Pasaporte">Pasaporte</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="tipo identificacion" class="form-label">Numero de identificación</label>
                                <input type="text" class="form-control" id="valor_identificacion" name="valor_identificacion" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="direccion" class="form-label">Dirección</label>
                            <input type="text" class="form-control" id="direccion" name="direccion" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Correo electrónico</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="contrasena" class="form-label">Contraseña</label>
                            <input type="password" class="form-control" id="contrasena" name="contrasena" required>
                        </div>
                        <div class="mb-3">
                            <label for="confirmar_contrasena" class="form-label">Confirmar contraseña</label>
                            <input type="password" class="form-control" id="confirmar_contrasena"
                                name="confirmar_contrasena" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Registrarse</button>
                        <div class="mt-3 text-center">
                            <p>¿Ya tienes una cuenta? <a href="{{ route('login') }}">Inicia sesión</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


@endsection