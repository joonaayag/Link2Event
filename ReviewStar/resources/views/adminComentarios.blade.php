@extends('layouts.base')

@section('titulo', '- Admin Comentarios')

@section('claseBody', 'class=pagina-adminComentarios')

@section('contenido')

    <div class="container">
        <h2>Comentarios de {{ Auth::user()->name }}</h2>

        @foreach ($comentarios as $comentario)
            <div class="card mb-3">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <img src="{{ $comentario->foto_perfil }}" alt="Foto de {{ $comentario->nombre_usuario }}" class="rounded-circle me-2" width="50">
                        <div>
                            <h5 class="mb-0">{{ $comentario->nombre_usuario }}</h5>
                            <small class="text-muted">{{ $comentario->email_usuario }}</small>
                        </div>
                    </div>
                    <p class="mt-2">{{ $comentario->comentario }}</p>
                </div>
            </div>
        @endforeach
    </div>


@endsection