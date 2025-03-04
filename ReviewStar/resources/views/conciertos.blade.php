@extends('layouts.app')
@section('titulo', '- Eventos')
@section('contenido')

<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-6">Eventos en {{ $userCountry }}</h1>
<div id="eventos-container" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @foreach($eventos as $evento)
        <div class="evento-card bg-white shadow-md rounded-lg overflow-hidden">
            <div class="relative">
                @if(isset($evento['images'][0]['url']))
                    <img src="{{ $evento['images'][0]['url'] }}" 
                         alt="{{ $evento['name'] }}" 
                         class="w-full h-48 object-cover">
                @endif
            </div>
            <div class="p-6">
                <h2 class="text-xl font-semibold mb-2">{{ $evento['name'] ?? 'Nombre no disponible' }}</h2>
                
                <div class="mb-4">
                    <p class="text-gray-600">
                        <strong>Fecha:</strong> 
                        {{ \Carbon\Carbon::parse($evento['dates']['start']['dateTime'] ?? $evento['dates']['start']['localDate'])->format('d/m/Y H:i') }}
                    </p>
                    
                    @if(isset($evento['_embedded']['venues'][0]['name']))
                    <p class="text-gray-600">
                        <strong>Lugar:</strong> 
                        {{ $evento['_embedded']['venues'][0]['name'] }}
                    </p>
                    @endif

                    @if(isset($evento['classifications'][0]['genre']['name']))
                    <p class="text-gray-600">
                        <strong>Género:</strong> 
                        {{ $evento['classifications'][0]['genre']['name'] }}
                    </p>
                    @endif
                </div>

                <div class="flex justify-between items-center">
                    @if(isset($evento['url']))
                    <a href="{{ $evento['url'] }}" 
                       target="_blank"
                       class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">
                        Comprar Entradas
                    </a>
                    @endif
                </div>
            </div>
        </div>
    @endforeach
</div>

<div id="loading" class="text-center my-4 hidden">
    <p>Cargando más eventos...</p>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        let page = {{ $currentPage }};
        let totalPages = {{ $totalPages }};
        let isLoading = false;
        const userCountry = '{{ $userCountry }}';

        function loadMoreEvents() {
            if (isLoading || page >= totalPages - 1) return;

            isLoading = true;
            document.getElementById('loading').classList.remove('hidden');

            fetch(`/eventos/load-more?page=${page + 1}&country=${userCountry}`)
                .then(response => response.json())
                .then(data => {
                    const container = document.getElementById('eventos-container');
                    
                    data.eventos.forEach(evento => {
                        const eventoCard = createEventoCard(evento);
                        container.appendChild(eventoCard);
                    });

                    page = data.currentPage;
                    totalPages = data.totalPages;
                    isLoading = false;
                    document.getElementById('loading').classList.add('hidden');
                })
                .catch(error => {
                    console.error('Error:', error);
                    isLoading = false;
                    document.getElementById('loading').classList.add('hidden');
                });
        }

        function createEventoCard(evento) {
            const div = document.createElement('div');
            div.className = 'evento-card bg-white shadow-md rounded-lg overflow-hidden';
            
            // Aquí generarías el HTML del evento similar a la vista Blade
            div.innerHTML = `
                <div class="relative">
                    ${evento.images && evento.images.length > 0 ? 
                        `<img src="${evento.images[0].url}" 
                               alt="${evento.name}" 
                               class="w-full h-48 object-cover">` : ''}
                </div>
                <div class="p-6">
                    <h2 class="text-xl font-semibold mb-2">${evento.name}</h2>
                    
                    <div class="mb-4">
                        <p class="text-gray-600">
                            <strong>Fecha:</strong> 
                            ${formatDate(evento.dates.start.dateTime || evento.dates.start.localDate)}
                        </p>
                        
                        ${evento._embedded && evento._embedded.venues && evento._embedded.venues.length > 0 ? 
                            `<p class="text-gray-600">
                                <strong>Lugar:</strong> 
                                ${evento._embedded.venues[0].name}
                            </p>` : ''}

                        ${evento.classifications && evento.classifications.length > 0 && evento.classifications[0].genre ? 
                            `<p class="text-gray-600">
                                <strong>Género:</strong> 
                                ${evento.classifications[0].genre.name}
                            </p>` : ''}
                    </div>

                    <div class="flex justify-between items-center">
                        ${evento.url ? 
                            `<a href="${evento.url}" 
                               target="_blank"
                               class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">
                                Comprar Entradas
                            </a>` : ''}
                    </div>
                </div>
            `;

            return div;
        }

        function formatDate(dateString) {
            const date = new Date(dateString);
            return date.toLocaleDateString('es-ES', { 
                year: 'numeric', 
                month: '2-digit', 
                day: '2-digit',
                hour: '2-digit',
                minute: '2-digit'
            });
        }

        // Implementar scroll infinito
        window.addEventListener('scroll', () => {
            if (window.innerHeight + window.scrollY >= document.body.offsetHeight - 500) {
                loadMoreEvents();
            }
        });
    });
</script>
@endpush
</div>
@endsection