@extends('layouts.base')
@section('titulo', '- Bienvenida')

@section('claseBody', 'class=pagina-registrarse')

@section('contenido')
    {{-- SCRIPTS EN ESTA PÁGINA --}}
    <script src="{{ asset('js/scriptNacionalidades.js') }}" defer></script>
    <script src="{{ asset('js/validacionEditarUsuario.js') }}" defer></script>
    <script src="{{ asset('js/validarPatrones.js') }}" defer></script>

    <div class="container d-flex justify-content-center align-items-center">
        <div class="col-md-6">
            <div class="card tarjeta-formulario">
                <div class="card-header">
                    <h3 class="mb-0 negrita">Editar perfil de {{ $usuario->nombre }} {{ $usuario->apellidos }}</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('editarPerfilUsuario') }}" method="POST">
                        @csrf
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="nombre" class="form-label">Nombre</label>
                                <input type="text" class="form-control @error('nombre') is-invalid @enderror" id="nombre"
                                    name="nombre" value="{{ old('nombre', $usuario->nombre) }}" required>
                                @error('nombre')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="apellidos" class="form-label">Apellidos</label>
                                <input type="text" class="form-control @error('apellidos') is-invalid @enderror"
                                    id="apellidos" name="apellidos" value="{{ old('apellidos', $usuario->apellidos) }}"
                                    required>
                                @error('apellidos')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="edad" class="form-label">Edad</label>
                                <input type="number"
                                    class="form-control @error('edad') is-invalid @enderror" id="edad" name="edad"
                                    value="{{ old('edad', $usuario->edad) }}" required>
                                @error('edad')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="pais" class="form-label">País</label>
                                <div class="contenedor-select">
                                    <select name="pais" id="pais" class="form-control @error('pais') is-invalid @enderror">
                                        <option value="{{ $usuario->pais }}" selected>{{ $usuario->pais }}
                                        </option>
                                    </select>
                                    <svg viewBox="25 25 50 50" id="iconoCargando">
                                        <circle r="20" cy="50" cx="50"></circle>
                                    </svg>
                                    @error('pais')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="tipo_identificacion" class="form-label">Tipo de identificación</label>
                                <select name="tipo_identificacion"
                                    class="form-control @error('tipo_identificacion') is-invalid @enderror"
                                    id="tipo_identificacion">
                                    <option value="DNI" {{ old('tipo_identificacion', $usuario->tipo_identificacion) == 'DNI' ? 'selected' : '' }}>
                                        DNI
                                    </option>
                                    <option value="NIE" {{ old('tipo_identificacion', $usuario->tipo_identificacion) == 'NIE' ? 'selected' : '' }}>
                                        NIE
                                    </option>
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
                                    value="{{ old('num_identificacion', $usuario->num_identificacion) }}" required>
                                @error('num_identificacion')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="direccion" class="form-label">Dirección</label>
                            <input type="text" class="form-control @error('direccion') is-invalid @enderror"
                                id="direccion" name="direccion" value="{{ old('direccion', $usuario->direccion) }}"
                                required>
                            @error('direccion')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Correo electrónico</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                                name="email" value="{{ old('email', $usuario->email) }}" required>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <input type="hidden" name="id_usuario" value="{{ $usuario->id }}">
                        <button type="submit" class="btn btn-primary w-100 btn-registro" id="botonRegistrarse">Editar
                            perfil</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

