<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;

class EventosController extends Controller
{
    public function index()
    {
        $apiKey = 'NaABMVnPL3zTNZQa5eaP5AEuVTf4V0Aw';
        $baseUrl = 'https://app.ticketmaster.com/discovery/v2/events.json';

        try {
            // Obtener el país del usuario autenticado (asumiendo que tienes esta información)
            $userCountry = Auth::user()->pais ?? 'ES'; // Por defecto España

            // Llamada a la API de Ticketmaster con parámetros optimizados
            $response = Http::get($baseUrl, [
                'apikey' => $apiKey,
                'countryCode' => $userCountry, // País del usuario
                'size' => 50, // Número de resultados por página
                'page' => 0, // Primera página
                'sort' => 'date,asc', // Ordenar por fecha ascendente
                'includeTBA' => 'no', // Excluir eventos sin fecha confirmada
                'includeTBD' => 'no' // Excluir eventos con fecha tentativa
            ]);
            
            // Verificar si la solicitud fue exitosa
            if ($response->successful()) {
                $data = $response->json();
                
                // Extraer información relevante
                $eventos = $data['_embedded']['events'] ?? [];
                $totalPages = $data['page']['totalPages'] ?? 1;

                // Preparar vista con eventos
                return view('eventos.index', [
                    'eventos' => $eventos,
                    'totalPages' => $totalPages,
                    'currentPage' => 0,
                    'userCountry' => $userCountry
                ]);
            } else {
                // Manejo de errores si la API no responde correctamente
                return view('eventos.index')->with('error', 'No se pudieron cargar los eventos');
            }
        } catch (\Exception $e) {
            // Manejo de errores de conexión
            return view('eventos.index')->with('error', 'Error al conectar con Ticketmaster: ' . $e->getMessage());
        }
    }

    // Método para cargar más eventos mediante AJAX
    public function loadMoreEvents(Request $request)
    {
        $apiKey = 'NaABMVnPL3zTNZQa5eaP5AEuVTf4V0Aw';
        $baseUrl = 'https://app.ticketmaster.com/discovery/v2/events.json';

        try {
            $page = $request->input('page', 1);
            $userCountry = $request->input('country', 'ES');

            $response = Http::get($baseUrl, [
                'apikey' => $apiKey,
                'countryCode' => $userCountry,
                'size' => 50,
                'page' => $page,
                'sort' => 'date,asc',
                'includeTBA' => 'no',
                'includeTBD' => 'no'
            ]);

            if ($response->successful()) {
                $data = $response->json();
                $eventos = $data['_embedded']['events'] ?? [];

                return response()->json([
                    'eventos' => $eventos,
                    'totalPages' => $data['page']['totalPages'] ?? 1,
                    'currentPage' => $page
                ]);
            } else {
                return response()->json(['error' => 'No se pudieron cargar más eventos'], 400);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}