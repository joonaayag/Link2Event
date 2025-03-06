@extends('layouts.base')
@section('titulo', '- Bienvenida')

@section('claseBody', 'class=pagina-panelAdministrador')

@section('contenido')
    <div class="text-center">
        <h1>Bienvenido, {{ Auth::user()->nombre }}</h1>
    </div>

    <div class="container mt-5">
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
                            <form action="{{ route('eliminarUsuario') }}" method="post">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="id_usuario" value="{{ $usuario->id }}">
                                <button type="submit" class="btn btn-danger">Eliminar usuario</button>
                            </form>
                            <!-- Editar Usuario -->
                            <form action="{{ route('editarUsuario') }}" method="get">
                                @csrf
                                <input type="hidden" name="id_usuario" value="{{ $usuario->id }}">
                                <button type="submit" class="btn btn-warning">Editar Usuario</button>
                            </form>
                            <!-- Ver mensajes -->


                            <form action="{{ route('mostrarComentarios') }}" method="get">
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
