<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Concierto;
use Carbon\Carbon;

class EventosController extends Controller
{
    public function index()
    {
        // Obtener eventos de hoy
        $today = Carbon::now()->format('Y-m-d');
        $conciertos = Concierto::whereDate('fecha', $today)
            ->paginate(9); // 9 eventos por página para un diseño de 3 columnas

        return view('conciertos', compact('conciertos'));
    }

    // Método para búsqueda con filtros
    public function buscar(Request $request)
    {
        $query = Concierto::query();

        // Aplicar filtros si existen
        if ($request->filled('nombre')) {
            $query->where('nombre', 'like', '%' . $request->nombre . '%');
        }

        if ($request->filled('ciudad')) {
            $query->where('ciudad', 'like', '%' . $request->ciudad . '%');
        }

        if ($request->filled('fecha_desde')) {
            $query->where('fecha', '>=', $request->fecha_desde);
        }

        if ($request->filled('fecha_hasta')) {
            $query->where('fecha', '<=', $request->fecha_hasta);
        }

        if ($request->filled('genero')) {
            $query->where('genero', $request->genero);
        }

        if ($request->filled('precio_min')) {
            $query->where('precio', '>=', $request->precio_min);
        }

        if ($request->filled('precio_max')) {
            $query->where('precio', '<=', $request->precio_max);
        }

        $conciertos = $query->paginate(9);

        return view('eventos', compact('conciertos'));
    }
}