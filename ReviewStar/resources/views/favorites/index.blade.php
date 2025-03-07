@extends('layouts.base')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h2>Mis Eventos Favoritos</h2>
                </div>
                <div class="card-body">
                    @if($favorites && $favorites->count() > 0)
                        <div class="row">
                            @foreach($favorites as $favorite)
                                <div class="col-md-4 col-sm-6 mb-4">
                                    <div class="card h-100 shadow-sm">
                                        <img src="{{ $favorite->event_image ?? 'https://via.placeholder.com/300' }}" class="card-img-top" alt="{{ $favorite->event_name }}">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $favorite->event_name }}</h5>
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
                                                    <a href="{{ $favorite->event_url }}" target="_blank" class="btn btn-primary">Comprar Entradas</a>
                                                @endif
                                                <button 
                                                    class="btn btn-danger remove-favorite" 
                                                    data-event-id="{{ $favorite->event_id }}"
                                                >
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
                        <a href="{{ route('eventos') }}" class="btn btn-primary">Ver eventos disponibles</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Manejar la eliminación de favoritos
        document.querySelectorAll('.remove-favorite').forEach(button => {
            button.addEventListener('click', function() {
                const eventId = this.getAttribute('data-event-id');
                const card = this.closest('.col-md-4');
                
                if (confirm('¿Estás seguro de que deseas eliminar este evento de tus favoritos?')) {
                    fetch('{{ route('favorites.destroy') }}', {
                        method: 'DELETE',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            event_id: eventId
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            card.remove();
                            
                            // Si ya no quedan tarjetas, mostrar mensaje
                            if (document.querySelectorAll('.col-md-4').length === 0) {
                                document.querySelector('.card-body').innerHTML = `
                                    <div class="alert alert-info">
                                        No tienes eventos favoritos guardados. ¡Explora los eventos disponibles y guarda tus favoritos!
                                    </div>
                                    <a href="{{ route('eventos') }}" class="btn btn-primary">Ver eventos disponibles</a>
                                `;
                            }
                        } else {
                            alert('Error al eliminar: ' + data.message);
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Error al procesar la solicitud');
                    });
                }
            });
        });
    });
</script>
@endsection