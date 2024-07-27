<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\SerieCollection;
use App\Http\Resources\SerieResource;
use App\Models\Serie;
use Illuminate\Http\Request;

class SerieController extends Controller
{
    public function index()
    {

        $series = Serie::ListarSeriesPaginacion();
        $serieData = new SerieCollection($series);

        // Crear la respuesta personalizada sin los campos 'links' y'meta'
        $response = [
            'data' => $serieData,
            'total' => $series->total(),
            'per_page' => $series->perPage(),
            'current_page' => $series->currentPage(),
        ];
        return response()->json($response);

    }

    public function show($serieId)
    {
        $serie = Serie::with(['comite', 'categoria', 'videos'])
        ->findOrFail($serieId);
        
        if (!$serie) {
            return response()->json([
                'message' => 'Serie no encontrado.'
            ], 404);
        }

        return new SerieResource($serie);
    }
}
