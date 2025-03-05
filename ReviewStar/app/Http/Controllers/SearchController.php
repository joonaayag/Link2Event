<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Concierto;
use Carbon\Carbon;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        // Validación en el backend de todos los campos del formulario
        $data = $request->validate([
            'nombre'             => 'nullable|string|max:255',
            'ciudad'             => 'nullable|string|max:255',
            'fecha_desde'       => 'nullable|date',
            'fecha_hasta'         => 'nullable|date|after_or_equal:fecha_desde',
            'genero'            => 'nullable|string|in:Rock,Pop,Classical,Hip-Hop/Rap,Jazz,Alternative',
            'precio_min'       => 'nullable|numeric|min:0',
            'precio_max'       => 'nullable|numeric|min:0|gte:precio_min',
        ]);

        // Obtener los conciertos desde la base de datos
        $conciertos = Concierto::query();

        // Aplicar filtros si existen
        if (!empty($data['nombre'])) {
            $conciertos->where('nombre', 'like', '%' . $data['nombre'] . '%');
        }
        if (!empty($data['ciudad'])) {
            $conciertos->where('ciudad', 'like', '%' . $data['ciudad'] . '%');
        }
        if (!empty($data['fecha_desde'])) {
            $conciertos->where('fecha', '>=', $data['fecha_desde']);
        }
        if (!empty($data['fecha_hasta'])) {
            $conciertos->where('fecha', '<=', $data['fecha_hasta']);
        }
        if (!empty($data['genero'])) {
            $conciertos->where('genero', $data['genero']);
        }
        if (!empty($data['precio_min'])) {
            $conciertos->where('precio', '>=', $data['precio_min']);
        }
        if (!empty($data['precio_max'])) {
            $conciertos->where('precio', '<=', $data['precio_max']);
        }

        // Paginación
        $conciertos = $conciertos->paginate(10);

        return view('filter', compact('data', 'conciertos'));
    }

    public function mostrarConciertos(Request $request)
    {
        $concerts = $request->input('concerts', []);
        $filtros = $request->input('filtros', []);
        
        $processedConcerts = [];
        foreach ($concerts as $concert) {
            $processedConcerts[] = [
                'event_id' => $concert['id'] ?? '',
                'nombre' => $concert['name'] ?? '',
                'fecha' => isset($concert['dates']['start']['localDate']) ? $concert['dates']['start']['localDate'] : null,
                'hora' => isset($concert['dates']['start']['localTime']) ? $concert['dates']['start']['localTime'] : null,
                'lugar' => isset($concert['_embedded']['venues'][0]['name']) ? $concert['_embedded']['venues'][0]['name'] : '',
                'ciudad' => isset($concert['_embedded']['venues'][0]['city']['name']) ? $concert['_embedded']['venues'][0]['city']['name'] : '',
                'imagen' => isset($concert['images'][0]['url']) ? $concert['images'][0]['url'] : '',
                'genero' => isset($concert['classifications'][0]['genre']['name']) ? $concert['classifications'][0]['genre']['name'] : '',
                'precio' => isset($concert['priceRanges'][0]['min']) ? $concert['priceRanges'][0]['min'] : 0,
                'url' => $concert['url'] ?? '#',
            ];
        }
        
        $html = view('partials.conciertos-list', ['conciertos' => $processedConcerts])->render();
        
        return response()->json([
            'success' => true,
            'html' => $html
        ]);
    }
}