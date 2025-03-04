<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Filtrado de Conciertos</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
    }
    h1 {
      text-align: center;
    }
    form {
      display: flex;
      flex-direction: column;
      align-items: center;
      margin: 0 auto;
      max-width: 400px;
    }
    div {
      margin: 10px 0;
    }
    label {
      display: block;
    }
    input, select {
      width: 100%;
      padding: 5px;
      font-size: 1em;
    }
    button {
      padding: 10px;
      font-size: 1em;
      background-color: #007bff;
      color: white;
      border: none;
      cursor: pointer;
    }
    button:hover {
      background-color: #0056b3;
    }
    #results-container {
      margin-top: 30px;
      padding: 15px;
      max-width: 800px;
      margin-left: auto;
      margin-right: auto;
    }
    .concert-card {
      border: 1px solid #ddd;
      margin-bottom: 15px;
      padding: 15px;
      border-radius: 5px;
    }
  </style>
</head>
<body>
  <script src="{{ asset('js/concierto.js') }}"></script>
  <script src="{{ asset('js/validaFormulario.js') }}"></script>
  <h1>Filtrar Conciertos</h1>
  <form id="filterForm">
    @csrf
    <div>
      <label for="nombre">Nombre:</label>
      <input type="text" id="nombre" name="nombre" placeholder="Nombre del concierto o evento">
    </div>
    <div>
      <label for="ciudad">Ciudad:</label>
      <input type="text" id="ciudad" name="ciudad" placeholder="Ciudad">
    </div>
    <div>
      <label for="fecha_desde">Fecha de Evento (Inicio):</label>
      <input type="date" id="fecha_desde" name="fecha_desde">
    </div>
    <div>
      <label for="fecha_hasta">Fecha de Evento (Fin):</label>
      <input type="date" id="fecha_hasta" name="fecha_hasta">
    </div>
    <div>
      <label for="genero">Género:</label>
      <select id="genero" name="genero">
        <option value="">-- Todos --</option>
        <option value="Rock">Rock</option>
        <option value="Pop">Pop</option>
        <option value="Classical">Classical</option>
        <option value="Hip-Hop/Rap">Hip-Hop/Rap</option>
        <option value="Jazz">Jazz</option>
        <option value="Alternative">Alternative</option>
        <option value="Basketball">Basketball</option>
        <option value="Hockey">Hockey</option>
        <option value="Football">Football</option>
        <option value="Fairs&Festivals">Fairs & Festivals</option>

      </select>
    </div>
    <div>
      <label for="precio_min">Precio Mínimo:</label>
      <input type="number" id="precio_min" name="precio_min" step="0.01" min="0" placeholder="0.00">
    </div>
    <div>
      <label for="precio_max">Precio Máximo:</label>
      <input type="number" id="precio_max" name="precio_max" step="0.01" min="0" placeholder="0.00">
    </div>
    <div>
      <button type="submit">Filtrar</button>
    </div>
  </form>

  <div id="results-container">
    @if(isset($conciertos) && count($conciertos) > 0)
      @foreach($conciertos as $concierto)
        <div class="concert-card">
          <h3>{{ $concierto['nombre'] }}</h3>
          <p><strong>Fecha:</strong> {{ $concierto['fecha'] }}</p>
          <p><strong>Lugar:</strong> {{ $concierto['lugar'] }}, {{ $concierto['ciudad'] }}</p>
          <p><strong>Género:</strong> {{ $concierto['genero'] }}</p>
          <p><strong>Precio:</strong> {{ $concierto['precio'] }}</p>
        </div>
      @endforeach
    @elseif(isset($conciertos))
      <p>No se encontraron conciertos con los filtros seleccionados.</p>
    @endif
  </div>
</body>
</html>