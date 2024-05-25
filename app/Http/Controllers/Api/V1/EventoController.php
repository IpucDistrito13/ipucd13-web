<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\EventoResource;
use App\Models\Evento;
use Illuminate\Http\Request;

class EventoController extends Controller
{
    public function index()
    {
        $eventos = Evento::paginate(10);
    
        // Transformar la colección de eventos usando el Resource
        $eventosData = EventoResource::collection($eventos->items());
    
        // Crear la respuesta personalizada sin los campos 'links' y 'meta'
        $response = [
            'data' => $eventosData,
            'total' => $eventos->total(),
            'per_page' => $eventos->perPage(),
            'current_page' => $eventos->currentPage(),
            'last_page' => $eventos->lastPage(),
        ];
    
        return response()->json($response);
    }
}
