@extends('layouts.base')
@section('titulo', '- Bienvenida')

@section('claseBody', 'class=pagina-registrarse')

@section('contenido')
    {{-- SCRIPTS EN ESTA PÁGINA --}}
    <script src="{{ asset('js/scriptNacionalidades.js') }}" defer></script>
    <script src="{{ asset('js/validacionRegistro.js') }}" defer></script>

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
                                <input type="text" class="form-control" id="nombre" name="nombre"
                                    value="{{ $usuario->nombre }}" required>
                            </div>
                            <div class="col-md-6">
                                <label for="apellidos" class="form-label">Apellidos</label>
                                <input type="text" class="form-control" id="apellidos" name="apellidos"
                                    value="{{ $usuario->apellidos }}" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="edad" class="form-label">Edad</label>
                                <input type="number" class="form-control" id="edad" name="edad"
                                    value="{{ $usuario->edad }}" required>
                            </div>
                            <div class="col-md-6">
                                <label for="pais" class="form-label">País</label>
                                <div class="contenedor-select">
                                    <select name="pais" id="pais" class="form-control">
                                        <option value="{{ $usuario->pais }}" selected>{{ $usuario->pais }}
                                        </option>
                                    </select>
                                    <svg viewBox="25 25 50 50" id="iconoCargando">
                                        <circle r="20" cy="50" cx="50"></circle>
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="tipo_identificacion" class="form-label">Tipo de identificación</label>
                                <select name="tipo_identificacion" id="tipo_identificacion" class="form-control">
                                    <option value="DNI" {{ $usuario->tipo_identificacion == 'DNI' ? 'selected' : '' }}>
                                        DNI
                                    </option>
                                    <option value="NIE" {{ $usuario->tipo_identificacion == 'NIE' ? 'selected' : '' }}>
                                        NIE
                                    </option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="num_identificacion" class="form-label">Número de identificación</label>
                                <input type="text" class="form-control" id="num_identificacion" name="num_identificacion"
                                    value="{{ $usuario->num_identificacion }}" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="direccion" class="form-label">Dirección</label>
                            <input type="text" class="form-control" id="direccion" name="direccion"
                                value="{{ $usuario->direccion }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Correo electrónico</label>
                            <input type="email" class="form-control" id="email" name="email"
                                value="{{ $usuario->email }}" required>
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
