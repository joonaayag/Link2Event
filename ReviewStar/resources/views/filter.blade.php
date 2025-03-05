<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Eventos de Hoy</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        #filterForm {
            display: none;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="row mb-4 align-items-center">
            <div class="col-md-8">
                <h1 class="text-center">Eventos de Hoy</h1>
            </div>
            <div class="col-md-4 text-end">
                <button id="toggleFilter" class="btn btn-outline-primary">
                    <i class="fas fa-filter"></i> Mostrar Filtros
                </button>
            </div>
        </div>
        
        <form id="filterForm" class="mb-4">
            @csrf
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="nombre" class="form-label">Nombre:</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre del concierto o evento">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="ciudad" class="form-label">Ciudad:</label>
                    <input type="text" class="form-control" id="ciudad" name="ciudad" placeholder="Ciudad">
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="fecha_desde" class="form-label">Fecha de Evento (Inicio):</label>
                    <input type="date" class="form-control" id="fecha_desde" name="fecha_desde">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="fecha_hasta" class="form-label">Fecha de Evento (Fin):</label>
                    <input type="date" class="form-control" id="fecha_hasta" name="fecha_hasta">
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="genero" class="form-label">Género:</label>
                    <select class="form-select" id="genero" name="genero">
                        <option value="">-- Todos --</option>
                        <option value="Rock">Rock</option>
                        <option value="Pop">Pop</option>
                        <option value="Classical">Classical</option>
                        <option value="Hip-Hop/Rap">Hip-Hop/Rap</option>
                        <option value="Jazz">Jazz</option>
                        <option value="Alternative">Alternative</option>
                    </select>
                </div>
                <div class="col-md-3 mb-3">
                    <label for="precio_min" class="form-label">Precio Mínimo:</label>
                    <input type="number" class="form-control" id="precio_min" name="precio_min" step="0.01" min="0" placeholder="0.00">
                </div>
                <div class="col-md-3 mb-3">
                    <label for="precio_max" class="form-label">Precio Máximo:</label>
                    <input type="number" class="form-control" id="precio_max" name="precio_max" step="0.01" min="0" placeholder="0.00">
                </div>
            </div>
            
            <div class="text-center">
                <button type="submit" class="btn btn-primary">Filtrar</button>
            </div>
        </form>

        <div id="results-container">
            @if(isset($conciertos) && $conciertos->count() > 0)
                <div class="row">
                    @foreach($conciertos as $concierto)
                        <div class="col-md-4 mb-4">
                            <div class="card">
                                @if($concierto->imagen)
                                    <img src="{{ $concierto->imagen }}" class="card-img-top" alt="{{ $concierto->nombre }}">
                                @endif
                                <div class="card-body">
                                    <h5 class="card-title">{{ $concierto->nombre }}</h5>
                                    <p class="card-text">
                                        <strong>Fecha:</strong> {{ $concierto->fecha }}
                                        @if($concierto->hora)
                                            {{ $concierto->hora }}
                                        @endif
                                        <br>
                                        <strong>Lugar:</strong> {{ $concierto->lugar }}, {{ $concierto->ciudad }}
                                        <br>
                                        <strong>Género:</strong> {{ $concierto->genero }}
                                        <br>
                                        <strong>Precio:</strong> ${{ number_format($concierto->precio, 2) }}
                                    </p>
                                    <a href="{{ $concierto->url ?? '#' }}" class="btn btn-primary" target="_blank">Comprar Entradas</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{ $conciertos->links() }}
            @elseif(isset($conciertos))
                <div class="alert alert-info text-center">
                    No se encontraron conciertos con los filtros seleccionados.
                </div>
            @endif
        </div>
    </div>

    <script src="{{ asset('js/concierto.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toggleFilterBtn = document.getElementById('toggleFilter');
            const filterForm = document.getElementById('filterForm');
            
            toggleFilterBtn.addEventListener('click', function() {
                if (filterForm.style.display === 'none' || filterForm.style.display === '') {
                    filterForm.style.display = 'block';
                    this.innerHTML = '<i class="fas fa-times"></i> Ocultar Filtros';
                } else {
                    filterForm.style.display = 'none';
                    this.innerHTML = '<i class="fas fa-filter"></i> Mostrar Filtros';
                }
            });
        });
    </script>
</body>
</html>