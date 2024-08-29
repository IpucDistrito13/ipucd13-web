<?php

namespace App\Http\Controllers\Api\V2;

use App\Http\Controllers\Controller;
use App\Http\Resources\V2\Collection\VideoCollection;
use App\Http\Resources\VideoResource;
use App\Models\GenerarKeyApi;
use App\Models\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, $id)
    {
        $apiKey = $request->query('api_key');
    
        // Validar si la clave API es válida
        $apiKeyExists = GenerarKeyApi::ValidarKeyApi($apiKey)->exists();
    
        // Si la clave API no existe, devolver un mensaje de error con el código de estado 401
        if (!$apiKeyExists) {
            return response()->json([
                'error' => 'No autorizado',
                'message' => 'La clave API proporcionada no es válida.'
            ], 401);
        }
    
        // Obtener el video por ID con la relación de serie
        $video = Video::with('serie')->where('id', $id)->first();
    
        // Si no se encuentra el video, devolver un mensaje de error con el código de estado 404
        if (!$video) {
            return response()->json([
                'error' => 'No encontrado',
                'message' => 'El video solicitado no existe.'
            ], 404);
        }
    
        return new VideoResource($video);
    }
    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }


    public function getVideosBySerie(Request $request, $serieId)
    {
        //return 'videosSerie';
        $limit = $request->input('limit', 10);
        $offset = $request->input('offset', 0);


        $videos = Video::with('serie')->where('serie_id', $serieId)
        ->orderBy('updated_at', 'desc')
            ->offset($offset)
            ->limit($limit)
            ->get();

            return new VideoCollection($videos);
    }
}
