@if(count($conciertos) > 0)
    @foreach($conciertos as $concierto)
        <div class="concert-card">
            <h3>{{ $concierto['nombre'] }}</h3>
            @if(isset($concierto['imagen']) && $concierto['imagen'])
                <img src="{{ $concierto['imagen'] }}" alt="{{ $concierto['nombre'] }}" style="max-width: 200px;">
            @endif
            <p><strong>Fecha:</strong> {{ $concierto['fecha'] }} @if(isset($concierto['hora'])) {{ $concierto['hora'] }} @endif</p>
            <p><strong>Lugar:</strong> {{ $concierto['lugar'] }}, {{ $concierto['ciudad'] }}</p>
            <p><strong>Género:</strong> {{ $concierto['genero'] }}</p>
            <p><strong>Precio:</strong> {{ $concierto['precio'] }}</p>
        </div>
    @endforeach
@else
    <p>No se encontraron conciertos con los filtros seleccionados.</p>
@endif