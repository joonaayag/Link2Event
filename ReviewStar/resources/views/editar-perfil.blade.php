@extends('layouts.base')

@section('titulo', '- Editar Perfil')

@section('claseBody', 'class=pagina-perfil')

@section('contenido')
    <script src="{{ asset('js/scriptNacionalidades.js') }}" defer></script>
    <script src="{{ asset('js/ValidarPatrones.js') }}" defer></script>
    <script src="{{ asset('js/validarEditarPerfil.js') }}" defer></script>

    <div class="container d-flex justify-content-center align-items-center">
        <div class="row w-100">
            <div class="col-md-9 mx-auto">
                <div class="card tarjeta-formulario">
                    <div class="card-header">
                        <h2 class="mb-0 negrita">Editar perfil</h2>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('perfil.actualizar') }}" method="POST" enctype="multipart/form-data">
                            {{-- El enctype es para permitir subir archivos --}}
                            @csrf
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="nombre" class="form-label naranjita">Nombre</label>
                                    <input type="text" class="form-control @error('nombre') is-invalid @enderror"
                                        id="nombre" name="nombre" value="{{ old('nombre', Auth::user()->nombre) }}"
                                        >
                                    @error('nombre')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                </div>
                                <div class="col-md-6">
                                    <label for="apellidos" class="form-label naranjita">Apellidos</label>
                                    <input type="text" class="form-control @error('apellidos') is-invalid @enderror"
                                        id="apellidos" name="apellidos"
                                        value="{{ old('apellidos', Auth::user()->apellidos) }}" >
                                    @error('apellidos')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="tipo_identificacion" class="form-label naranjita">Tipo de identificación</label>
                                    <select class="form-select @error('tipo_identificacion') is-invalid @enderror"
                                        id="tipo_identificacion" name="tipo_identificacion" >
                                        <option value="NIF"
                                            {{ old('tipo_identificacion', Auth::user()->tipo_identificacion) == 'NIF' ? 'selected' : '' }}>
                                            NIF</option>
                                        <option value="DNI"
                                            {{ old('tipo_identificacion', Auth::user()->tipo_identificacion) == 'DNI' ? 'selected' : '' }}>
                                            DNI</option>
                                    </select>
                                    @error('tipo_identificacion')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="num_identificacion" class="form-label naranjita">Número de identificación</label>
                                    <input type="text"
                                        class="form-control @error('num_identificacion') is-invalid @enderror"
                                        id="num_identificacion" name="num_identificacion"
                                        value="{{ old('num_identificacion', Auth::user()->num_identificacion) }}" >
                                    @error('num_identificacion')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="email" class="form-label naranjita">Correo electrónico</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                        id="email" name="email" value="{{ old('email', Auth::user()->email) }}"
                                        >
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="edad" class="form-label naranjita">Edad</label>
                                    <input type="number" class="form-control @error('edad') is-invalid @enderror"
                                        id="edad" name="edad" value="{{ old('edad', Auth::user()->edad) }}"
                                         min="18">
                                    @error('edad')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="pais" class="form-label naranjita">País</label>
                                    <div class="contenedor-select">
                                        <select name="pais" id="pais" class="form-control">
                                            <option value="{{ old('pais', Auth::user()->pais) }}" selected disable>
                                            {{ old('pais', Auth::user()->pais) }}
                                            </option>
                                        </select>
                                        <svg viewBox="25 25 50 50" id="iconoCargando">
                                            <circle r="20" cy="50" cx="50"></circle>
                                        </svg>
                                    </div>
                                    @error('pais')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="direccion" class="form-label naranjita">Dirección</label>
                                    <input type="text" class="form-control @error('direccion') is-invalid @enderror"
                                        id="direccion" name="direccion"
                                        value="{{ old('direccion', Auth::user()->direccion) }}" >
                                    @error('direccion')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="foto_perfil" class="form-label naranjita">Modificar foto de perfil</label>
                                    <input type="file" name="foto_perfil" id="foto_perfil">
                                </div>
                            </div>

                            <hr>
                            <h5 class="negrita">Cambiar contraseña (opcional)</h5>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="password" class="form-label naranjita">Nueva contraseña</label>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                                        id="password" name="password">
                                    <small>Dejar en blanco para mantener la contraseña
                                        actual</small>
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="password_confirmation" class="form-label naranjita">Confirmar nueva
                                        contraseña</label>
                                    <input type="password" class="form-control" id="password_confirmation"
                                        name="password_confirmation">
                                </div>
                            </div>

                            <div class="d-flex justify-content-end mt-4">
                                <a href="{{ route('perfil') }}" class="btn btn-login btn-lg btn-block me-3" role="button">Cancelar</a>
                                <button type="submit" id="botonEditarPerfil" name="botonEditarPerfil" class="btn btn-registro btn-lg btn-block">Guardar cambios</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
