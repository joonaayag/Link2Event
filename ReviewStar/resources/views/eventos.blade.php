@extends('layouts.base')
@section('titulo', '- Eventos')
@section('contenido')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
<div class="container mt-5">
    <div class="card">
    <div class="row mb-4">
        <div class="col-md-12">
            <h1 class="text-center card-header">Eventos de Hoy</h1>
        </div>
    </div>

    <!-- Filtros siempre visibles -->
    <div id="filterForm" class="mb-2">
        <div class="row">
            <div class="col-md-6 mb-2">
                <label for="nombre" class="form-label">Nombre:</label>
                <input type="text" class="form-control" id="nombre" placeholder="Nombre del concierto o evento">
            </div>
            <div class="col-md-6 mb-2">
                <label for="ciudad" class="form-label">Ciudad:</label>
                <input type="text" class="form-control" id="ciudad" placeholder="Ciudad">
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-6 mb-2">
                <label for="fecha_desde" class="form-label">Fecha de Evento (Inicio):</label>
                <input type="date" class="form-control" id="fecha_desde">
            </div>
            <div class="col-md-6 mb-2">
                <label for="fecha_hasta" class="form-label">Fecha de Evento (Fin):</label>
                <input type="date" class="form-control" id="fecha_hasta">
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-6 mb-2">
                <label for="genero" class="form-label">Género:</label>
                <select class="form-select" id="genero">
                    <option value="">-- Cargando géneros... --</option>
                </select>
            </div>
            <div class="col-md-3 mb-2">
                <label for="precio_min" class="form-label">Precio Mínimo:</label>
                <input type="number" class="form-control" id="precio_min" step="0.01" min="0" placeholder="0.00">
            </div>
            <div class="col-md-3 mb-2">
                <label for="precio_max" class="form-label">Precio Máximo:</label>
                <input type="number" class="form-control" id="precio_max" step="0.01" min="0" placeholder="0.00">
            </div>
        </div>
        
        <div class="text-center">
            <button id="filterButton" class="btn btn-primary">Filtrar</button>
        </div>
    </div>
    <!-- Contenedor de Resultados -->
<div class="container mt-4">
    <div id="results-container" class="row justify-content-center"></div>
</div>
    </div>
</div>
        </div>
    </div>
</div>


<script src="{{ asset('js/concierto.js') }}"></script>
<script src="{{ asset('js/validarFiltros.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

@endsection
