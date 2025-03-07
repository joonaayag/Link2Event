<?php

namespace App\Http\Controllers;

use App\Models\FavoriteEvent;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cookie;

class FavoriteEventController extends BaseController
{
    // Constructor para asegurar que solo usuarios autenticados pueden acceder
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Listar eventos favoritos del usuario
    public function index()
{
    $user = \App\Models\Usuario::find(Auth::id());
    $favorites = $user ? $user->favoriteEvents()->orderBy('user_id', 'desc')->get() : collect(); // Devuelve una colección vacía si no hay usuario.

    return view('favorites.index', compact('favorites'));
}


    // Guardar un evento como favorito (AJAX)
    public function store(Request $request)
    {

            Log::info($request->all()); // Ver qué datos llegan sin detener la ejecución
        
        $validated = $request->validate([
            'event_id' => 'required|string',
            'event_name' => 'required|string',
            'event_image' => 'nullable|string',
            'event_date' => 'nullable|string',
            'event_venue' => 'nullable|string',
            'event_city' => 'nullable|string',
            'event_genre' => 'nullable|string',
            'event_url' => 'nullable|string',
        ]);

        try {
            $favorite = FavoriteEvent::updateOrCreate(
                [
                    'user_id' => Auth::id(),
                    'event_id' => $validated['event_id']
                ],
                [
                    'event_name' => $validated['event_name'],
                    'event_image' => $validated['event_image'] ?? null,
                    'event_date' => $validated['event_date'] ?? null,
                    'event_venue' => $validated['event_venue'] ?? null,
                    'event_city' => $validated['event_city'] ?? null,
                    'event_genre' => $validated['event_genre'] ?? null,
                    'event_url' => $validated['event_url'] ?? null,
                ]
            );

            return response()->json([
                'success' => true,
                'message' => 'Evento añadido a favoritos',
                'is_favorite' => true
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al añadir a favoritos: ' . $e->getMessage()
            ], 500);
        }
    }

    // Eliminar un evento de favoritos (AJAX)
    public function destroy(Request $request)
    {
        $validated = $request->validate([
            'event_id' => 'required|string',
        ]);

        try {
            $deleted = FavoriteEvent::where([
                'user_id' => Auth::id(),
                'event_id' => $validated['event_id']
            ])->delete();

            return response()->json([
                'success' => true,
                'message' => 'Evento eliminado de favoritos',
                'is_favorite' => false
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al eliminar de favoritos: ' . $e->getMessage()
            ], 500);
        }
    }

    // Verificar si un evento es favorito (AJAX)
    public function check(Request $request)
    {
        $eventId = $request->input('event_id');
        $isFavorite = FavoriteEvent::where('user_id', Auth::id())
            ->where('event_id', $eventId)
            ->exists();

        return response()->json([
            'is_favorite' => $isFavorite
        ]);
    }
}
