<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\SerieResource;
use App\Models\Serie;
use Illuminate\Http\Request;

class SerieController extends Controller
{
    public function index()
    {

        $series = Serie::with('comite', 'categoria')->paginate(10);
        $serieData = SerieResource::collection($series->items());

        // Crear la respuesta personalizada sin los campos 'links' y'meta'
        $response = [
            'data' => $serieData,
            'total' => $series->total(),
            'per_page' => $series->perPage(),
            'current_page' => $series->currentPage(),
            'last_page' => $series->lastPage(),
        ];
        return response()->json($response);



        /*
        $serie = Serie::paginate(10);

        // Transformar la colección usando el Resource
        $serieData = SerieResource::collection($serie->items());

        // Crear la respuesta personalizada sin los campos 'links' y'meta'
        $response = [
            'data' => $serieData,
            'total' => $serie->total(),
            'per_page' => $serie->perPage(),
            'current_page' => $serie->currentPage(),
            'last_page' => $serie->lastPage(),
        ];

        return response()->json($response);
        */
    }
}
