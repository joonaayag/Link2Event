@extends('layouts.base')

@section('titulo', '- Editar Perfil')

@section('contenido')
    <div class="container py-5">
        <div class="row">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">
                        <h4 class="mb-0">Editar perfil</h4>
                    </div>
                    <div class="card-body">

                        <form action="{{ route('perfil.actualizar') }}" method="POST">
                            @csrf
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="nombre" class="form-label">Nombre</label>
                                    <input type="text" class="form-control @error('nombre') is-invalid @enderror"
                                        id="nombre" name="nombre" value="{{ old('nombre', Auth::user()->nombre) }}"
                                        required>
                                    @error('nombre')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                </div>
                                <div class="col-md-6">
                                    <label for="apellidos" class="form-label">Apellidos</label>
                                    <input type="text" class="form-control @error('apellidos') is-invalid @enderror"
                                        id="apellidos" name="apellidos"
                                        value="{{ old('apellidos', Auth::user()->apellidos) }}" required>
                                    @error('apellidos')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="tipo_identificacion" class="form-label">Tipo de identificación</label>
                                    <select class="form-select @error('tipo_identificacion') is-invalid @enderror"
                                        id="tipo_identificacion" name="tipo_identificacion" required>
                                        <option value="NIF" {{ old('tipo_identificacion', Auth::user()->tipo_identificacion) == 'NIF' ? 'selected' : '' }}>NIF</option>
                                        <option value="DNI" {{ old('tipo_identificacion', Auth::user()->tipo_identificacion) == 'DNI' ? 'selected' : '' }}>DNI</option>
                                    </select>
                                    @error('tipo_identificacion')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="num_identificacion" class="form-label">Número de identificación</label>
                                    <input type="text"
                                        class="form-control @error('num_identificacion') is-invalid @enderror"
                                        id="num_identificacion" name="num_identificacion"
                                        value="{{ old('num_identificacion', Auth::user()->num_identificacion) }}" required>
                                    @error('num_identificacion')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="email" class="form-label">Correo electrónico</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                                        name="email" value="{{ old('email', Auth::user()->email) }}" required>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="edad" class="form-label">Edad</label>
                                    <input type="number" class="form-control @error('edad') is-invalid @enderror" id="edad"
                                        name="edad" value="{{ old('edad', Auth::user()->edad) }}" required min="18">
                                    @error('edad')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="nacionalidad" class="form-label">Nacionalidad</label>
                                    <input type="text" class="form-control @error('nacionalidad') is-invalid @enderror"
                                        id="nacionalidad" name="nacionalidad"
                                        value="{{ old('nacionalidad', Auth::user()->nacionalidad) }}" required>
                                    @error('nacionalidad')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="direccion" class="form-label">Dirección</label>
                                    <input type="text" class="form-control @error('direccion') is-invalid @enderror"
                                        id="direccion" name="direccion"
                                        value="{{ old('direccion', Auth::user()->direccion) }}" required>
                                    @error('direccion')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <hr>
                            <h5>Cambiar contraseña (opcional)</h5>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="password" class="form-label">Nueva contraseña</label>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                                        id="password" name="password">
                                    <small class="form-text text-muted">Dejar en blanco para mantener la contraseña
                                        actual</small>
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="password_confirmation" class="form-label">Confirmar nueva contraseña</label>
                                    <input type="password" class="form-control" id="password_confirmation"
                                        name="password_confirmation">
                                </div>
                            </div>

                            <div class="d-flex justify-content-end mt-4">
                                <a href="{{ route('perfil') }}" class="btn btn-secondary me-2">Cancelar</a>
                                <button type="submit" class="btn btn-success">Guardar cambios</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection