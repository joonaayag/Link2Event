@extends('layouts.base')
@section('titulo', '- Bienvenida')

@section('claseBody', 'class=pagina-panelAdministrador')

@section('contenido')
    <script src="{{ asset('js/claseNotificaciones.js') }}" defer></script>

    <div class="container mt-5">
        <div class="text-center">
            <h1 class="blanco negrita mediana">Bienvenido, {{ Auth::user()->nombre }}</h1>
        </div>

        <div class="container contenedor-panel mt-5">

            <!-- Muestra un mensaje de confirmación cuando se actualiza el perfil exitosamente -->
            @if (session('success'))
                <script>
                    document.addEventListener('DOMContentLoaded', function () {
                        const notificador = new Notificacion();
                        notificador.mostrar("{{ session('success') }}", 4000);
                    });
                </script>
            @endif

            <h2 class="blanco negrita card-header pb-2 mb-5">Lista de Usuarios</h2>
            @if ($usuarios->isEmpty())
                <p class="blanco text-center negrita">No hay usuarios registrados</p>
            @else
                <table class="tabla-usuarios">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Apellidos</th>
                            <th>Email</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($usuarios as $usuario)
                            <tr>
                                <td>{{ $usuario->nombre }}</td>
                                <td>{{ $usuario->apellidos }}</td>
                                <td>{{ $usuario->email }}</td>
                                <td>
                                    <!-- Eliminar Usuario -->
                                    <button type="button" class="btn btn-primary btn-modal boton-panel btn-danger" data-bs-toggle="modal"
                                        data-bs-target="#modal_{{ $usuario->id }}">
                                        Eliminar usuario
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="modal_{{ $usuario->id }}" tabindex="-1" role="dialog"
                                        aria-labelledby="modalTitle_{{ $usuario->id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content card">
                                                <div class="modal-header">
                                                    <h4 class="modal-title negrita">¿Eliminar usuario?</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <p>¿Seguro que quieres eliminar al usuario <strong> {{ $usuario->nombre }}
                                                            {{ $usuario->apellidos }}</strong>?
                                                    </p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Cerrar</button>
                                                    <form action="{{ route('eliminarUsuario') }}" method="post"
                                                        style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <input type="hidden" name="id_usuario" value="{{ $usuario->id }}">
                                                        <button type="submit" class="btn btn-danger">Eliminar</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Editar Usuario -->
                                    <form action="{{ route('editarUsuario') }}" method="post" style="display:inline;">
                                        @csrf
                                        <input type="hidden" name="id_usuario" value="{{ $usuario->id }}">
                                        <button type="submit" class="btn boton-panel btn-warning">Editar Usuario</button>
                                    </form>

                                    <!-- Ver mensajes -->
                                    <form action="{{ route('mostrarComentarios') }}" method="post" style="display:inline;">
                                        @csrf
                                        <input type="hidden" name="id_usuario" value="{{ $usuario->id }}">
                                        <button type="submit" class="btn boton-panel btn-info">Ver mensajes</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
@endsection