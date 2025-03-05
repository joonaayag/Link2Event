<div class="row">
    @if(count($conciertos) > 0)
        @foreach($conciertos as $concierto)
            <div class="col-md-4 mb-4">
                <div class="card">
                    @if(isset($concierto['imagen']) && $concierto['imagen'])
                        <img src="{{ $concierto['imagen'] }}" class="card-img-top" alt="{{ $concierto['nombre'] }}">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $concierto['nombre'] }}</h5>
                        <p class="card-text">
                            <strong>Fecha:</strong> {{ $concierto['fecha'] }} 
                            @if(isset($concierto['hora'])) 
                                {{ $concierto['hora'] }} 
                            @endif
                            <br>
                            <strong>Lugar:</strong> {{ $concierto['lugar'] }}, {{ $concierto['ciudad'] }}
                            <br>
                            <strong>Género:</strong> {{ $concierto['genero'] }}
                            <br>
                            <strong>Precio:</strong> ${{ number_format($concierto['precio'], 2) }}
                        </p>
                        <a href="{{ $concierto['url'] ?? '#' }}" class="btn btn-primary" target="_blank">Comprar Entradas</a>
                    </div>
                </div>
            </div>
        @endforeach
    @else
        <div class="col-12">
            <div class="alert alert-info text-center">
                No se encontraron conciertos con los filtros seleccionados.
            </div>
        </div>
    @endif
</div>