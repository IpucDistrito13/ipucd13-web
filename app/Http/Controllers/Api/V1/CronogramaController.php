<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\CronogramaResource;
use App\Models\Cronograma;
use Illuminate\Http\Request;

class CronogramaController extends Controller
{
    public function index()
    {
        $cronogramas = Cronograma::paginate(10);

        // Transformar la colección de eventos usando el Resource
        $cronogramaData = CronogramaResource::collection($cronogramas->items() );

        // Crear la respuesta personalizada sin los campos 'links' y 'meta'
        $response = [
            'data' => $cronogramaData,
            'total' => $cronogramas->total(),
            'per_page' => $cronogramas->perPage(),
            'current_page' => $cronogramas->currentPage(),
            'last_page' => $cronogramas->lastPage(),
        ];
    
        return response()->json($response);
    }
}
