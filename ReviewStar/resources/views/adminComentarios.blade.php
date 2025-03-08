@extends('layouts.base')

@section('titulo', '- Admin Comentarios')

@section('claseBody', 'class=pagina-adminComentarios')

@section('contenido')
<script src="{{ asset('js/claseNotificaciones.js') }}" defer></script>

    <div class="container mt-5">
        @if (count($comentarios) > 0)
            <h2 class="blanco negrita mb-4">Comentarios de {{ $comentarios[0]->nombre_usuario }}</h2>

            <!-- Muestra un mensaje de confirmación cuando se actualiza el perfil exitosamente -->
            @if (session('success'))
                <script>
                    document.addEventListener('DOMContentLoaded', function () {
                        const notificador = new Notificacion();
                        notificador.mostrar("{{ session('success') }}", 4000);
                    });
                </script>
            @endif

            @foreach ($comentarios as $comentario)
                <div class="card carta-comentario mb-4">
                    <div class="card-body position-relative">
                        <div class="boton-eliminarAdmin position-absolute bottom-0 end-0 mb-3">
                            <button type="button" class="btn btn-primary btn-modal btn-danger " data-bs-toggle="modal"
                                data-bs-target="#modal_{{ $comentario->id }}">
                                Eliminar comentario
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="modal_{{ $comentario->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="modalTitle_{{ $comentario->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title negrita">Eliminación de comentario</h4>
                                        </div>
                                        <div class="modal-body">
                                            <p>¿Seguro que quieres eliminar el comentario de
                                                <strong>{{ $comentario->nombre_usuario }}</strong>?
                                            </p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                            <form action="{{ route('eliminarComentario') }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <input type="hidden" name="id_comentario" id="id_comentario"
                                                    value="{{ $comentario->id }}">
                                                <input type="hidden" name="id_usuario" id="id_usuario"
                                                    value="{{ $comentario->id_usuario }}">
                                                <button type="submit" class="btn btn-danger">Eliminar</button>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <div>
                                <img class="rounded-circle"
                                    src="{{ $usuario->foto_perfil ? asset('storage/perfiles/' . $usuario->foto_perfil) : asset('assets/img/foto-default.png') }}"
                                    alt="" width="50px" height="50px">
                                <h5 class="mt-3 mb-0 negrita">{{ $comentario->nombre_usuario }}</h5>
                                <small class="naranjita">{{ $comentario->email_usuario }}</small>
                            </div>
                        </div>
                        <p class="mt-4">{{ $comentario->comentario }}</p>
                    </div>
                </div>
            @endforeach
        @else
            <p class="blanco">No hay comentarios disponibles para este usuario </p>
        @endif
    </div>


@endsection