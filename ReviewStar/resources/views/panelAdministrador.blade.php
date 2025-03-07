@extends('layouts.base')
@section('titulo', '- Bienvenida')

@section('claseBody', 'class=pagina-panelAdministrador')

@section('contenido')
    <div class="text-center">
        <h1>Bienvenido, {{ Auth::user()->nombre }}</h1>
    </div>

    <div class="container mt-5">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <h2>Lista de Usuarios</h2>

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
                            <button type="button" class="btn btn-primary btn-modal" data-bs-toggle="modal" data-bs-target="#modal_{{ $usuario->id }}">
                                Eliminar usuario
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="modal_{{ $usuario->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="modalTitle_{{ $usuario->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content card">
                                        <div class="modal-header">
                                            <h5 class="modal-title">¿Eliminar usuario?</h5>
                                        </div>
                                        <div class="modal-body">
                                            <p>¿Seguro que quieres eliminar al usuario {{ $usuario->nombre }} {{ $usuario->apellidos }}?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                            <form action="{{ route('eliminarUsuario') }}" method="post" style="display:inline;">
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
                                <button type="submit" class="btn btn-warning">Editar Usuario</button>
                            </form>

                            <!-- Ver mensajes -->
                            <form action="{{ route('mostrarComentarios') }}" method="post" style="display:inline;">
                                @csrf
                                <input type="hidden" name="id_usuario" value="{{ $usuario->id }}">
                                <button type="submit" class="btn btn-info">Ver mensajes</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
