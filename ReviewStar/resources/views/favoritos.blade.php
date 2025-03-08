@extends('layouts.base')

@section('titulo', '- Favoritos')

@section('claseBody', 'class=pagina-registrarse')

@section('contenido')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card tarjeta-formulario">
                    <div class="card-header">
                        <h2 class="negrita">Mis Eventos Favoritos</h2>
                    </div>
                    <div class="card-body">
                        @if($favorites && $favorites->count() > 0)
                            <div class="row">
                                @foreach($favorites as $favorite)
                                    <div class="col-md-6 col-sm-12 mb-4">
                                        <div class="card tarjeta-formularioBis carta-inicioBis">
                                            <img src="{{ $favorite->event_image ?? 'https://via.placeholder.com/300' }}"
                                                class="card-img-top" alt="{{ $favorite->event_name }}">
                                            <div class="card-body">
                                                <h5 class="card-title" id="tituloFav">{{ $favorite->event_name }}</h5>
                                                @if($favorite->event_date)
                                                    <p class="card-text"><strong>Fecha:</strong> {{ $favorite->event_date }}</p>
                                                @endif
                                                @if($favorite->event_venue)
                                                    <p class="card-text"><strong>Lugar:</strong> {{ $favorite->event_venue }}</p>
                                                @endif
                                                @if($favorite->event_city)
                                                    <p class="card-text"><strong>Ciudad:</strong> {{ $favorite->event_city }}</p>
                                                @endif
                                                @if($favorite->event_genre)
                                                    <p class="card-text"><strong>Género:</strong> {{ $favorite->event_genre }}</p>
                                                @endif

                                                <div class="d-flex justify-content-between mt-3">
                                                    @if($favorite->event_url)
                                                        <a href="{{ $favorite->event_url }}" target="_blank"
                                                            class="btn btn-primary btn-registroBis btn-modal mt-auto boton-comprar-favoritos">Comprar
                                                            Entradas</a>
                                                    @endif
                                                    <button
                                                        class="btn btn-danger btn-loginBisRemove btn-modal mt-auto remove-favorite boton-eliminar-favorito"
                                                        data-event-id="{{ $favorite->event_id }}"
                                                        data-event-name="{{ $favorite->event_name }}">
                                                        <i class="fas fa-heart-broken"></i> Eliminar
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="alert alert-info">
                                No tienes eventos favoritos guardados. ¡Explora los eventos disponibles y guarda tus favoritos!
                            </div>
                            <div class="text-center w-100">
                                <a href="{{ route('eventos') }}" class="btn btn-primary btn-loginBis btn-modal mt-3">Ver eventos
                                    disponibles</a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de Confirmación de Eliminación de Favoritos -->
    <div class="modal fade" id="modal-eliminar-favorito" tabindex="-1" role="dialog" aria-labelledby="modalTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title negrita">Eliminación de Favorito</h4>
                </div>
                <div class="modal-body">
                    <p>¿Seguro que deseas eliminar este evento de tus favoritos?</p>
                    <p id="evento-nombre"></p> <!-- Aquí pondremos el nombre del evento -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button id="eliminar-favorito-btn" class="btn btn-danger">Eliminar</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Manejar la eliminación de favoritos
            document.querySelectorAll('.remove-favorite').forEach(button => {
                button.addEventListener('click', function () {
                    const eventId = this.getAttribute('data-event-id');
                    const eventName = this.getAttribute('data-event-name'); // Obtener nombre del evento
                    const card = this.closest('.col-md-6');

                    // Mostrar modal de confirmación
                    const modal = new bootstrap.Modal(document.getElementById('modal-eliminar-favorito'));
                    document.getElementById('evento-nombre').innerText = eventName; // Mostrar nombre del evento en el modal

                    modal.show();

                    // Manejar el evento de eliminación
                    document.getElementById('eliminar-favorito-btn').onclick = function () {
                        fetch('{{ route('favorites.destroy') }}', {
                            method: 'DELETE',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({ event_id: eventId })
                        })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    card.remove();

                                    // Si ya no quedan tarjetas, mostrar mensaje
                                    if (document.querySelectorAll('.col-md-6').length === 0) {
                                        document.querySelector('.card-body').innerHTML = `
                                    <div class="alert alert-info">
                                        No tienes eventos favoritos guardados. ¡Explora los eventos disponibles y guarda tus favoritos!
                                    </div>
                                    <a href="{{ route('eventos') }}" class="btn btn-primary">Ver eventos disponibles</a>
                                `;
                                    }

                                    // Cerrar el modal
                                    modal.hide();

                                    // Mostrar mensaje de éxito
                                    Swal.fire('Eliminado', 'El evento ha sido eliminado de tus favoritos.', 'success');
                                } else {
                                    Swal.fire('Error', data.message || 'No se pudo eliminar el evento.', 'error');
                                }
                            })
                            .catch(error => {
                                console.error('Error:', error);
                                Swal.fire('Error', 'Hubo un problema con la solicitud.', 'error');
                            });
                    };
                });
            });
        });
    </script>
@endsection