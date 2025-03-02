@extends('layouts.base')

@section('titulo', '- Registrarse')

@section('claseBody', 'class=pagina-registrarse')

@section('contenido')

    <div class="container d-flex justify-content-center align-items-center">
        <div class="col-md-6">
            <div class="card tarjeta-formulario">
                <div class="card-header">
                    <h2 class="mb-0 negrita">Registrarse</h2>
                </div>
                <div class="card-body">
                    {{-- Los value que tienen "OLD" sirven para que el valor persista si hay un error en otro campo --}}
                    <form action="{{ route('registrar') }}" method="POST">
                        @csrf
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="nombre" class="form-label">Nombre</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" value="{{ old('nombre') }}" required>
                                @error('nombre')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="apellidos" class="form-label">Apellidos</label>
                                <input type="text" class="form-control" id="apellidos" name="apellidos" value="{{ old('apellidos') }}" required>
                                @error('apellidos')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="edad" class="form-label">Edad</label>
                                <input type="number" class="form-control" id="edad" name="edad" value="{{ old('edad') }}" required>
                                @error('edad')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="nacionalidad" class="form-label">Nacionalidad</label>
                                <select name="nacionalidad" id="nacionalidad" class="form-control">
                                </select>
                                @error('nacionalidad')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="tipo_identificacion" class="form-label">Tipo de identificación</label>
                                <select name="tipo_identificacion" id="tipo_identificacion" class="form-control">
                                    <option value="DNI" {{ old('tipo_identificacion') == 'DNI' ? 'selected' : '' }}>DNI</option>
                                    <option value="NIE" {{ old('tipo_identificacion') == 'NIE' ? 'selected' : '' }}>NIE</option>
                                </select>
                                @error('tipo_identificacion')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="num_identificacion" class="form-label">Número de identificación</label>
                                <input type="text" class="form-control" id="num_identificacion" name="num_identificacion" value="{{ old('num_identificacion') }}" required>
                                @error('num_identificacion')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="direccion" class="form-label">Dirección</label>
                            <input type="text" class="form-control" id="direccion" name="direccion" value="{{ old('direccion') }}" required>
                            @error('direccion')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Correo electrónico</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
                            @error('email')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Contraseña</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                            @error('password')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Confirmar contraseña</label>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                            @error('password_confirmation')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary w-100 btn-registro">Registrarse</button>
                        <div class="mt-3 text-center">
                            <p>¿Ya tienes una cuenta? <a href="{{ route('login') }}" class="enlaceAmarillo">Inicia sesión</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection