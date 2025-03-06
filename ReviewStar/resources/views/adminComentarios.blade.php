@extends('layouts.base')

@section('titulo', '- Admin Comentarios')

@section('claseBody', 'class=pagina-adminComentarios')

@section('contenido')

    <div class="container mt-5">
        @if (count($comentarios) > 0)
            <h2>Comentarios de {{ $comentarios[0]->nombre_usuario }}</h2>

            @foreach ($comentarios as $comentario)
                <div class="card mb-3">
                    <div class="card-body position-relative">
                        <div class="position-absolute top-0 end-0 mt-3">
                            <form action="{{ route('eliminarComentario', $comentario->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">
                                    Eliminar comentario
                                </button>
                            </form>
                        </div>
                        <div class="d-flex align-items-center">
                            <div>
                                <img class="rounded-circle"
                                    src="{{ $usuario->foto_perfil ? asset('storage/perfiles/' . $usuario->foto_perfil) : asset('assets/img/foto-default.png') }}"
                                    alt="" width="50px" height="50px">
                                <h5 class="mb-0">{{ $comentario->nombre_usuario }}</h5>
                                <small class="text-muted">{{ $comentario->email_usuario }}</small>
                            </div>
                        </div>
                        <p class="mt-2">{{ $comentario->comentario }}</p>
                    </div>
                </div>
            @endforeach
        @else
            <p>No hay comentarios disponibles.</p>
        @endif
    </div>


@endsection
