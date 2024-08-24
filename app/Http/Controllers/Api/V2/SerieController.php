<?php

namespace App\Http\Controllers\Api\V2;

use App\Http\Controllers\Controller;
use App\Http\Resources\ComiteCollection;
use App\Http\Resources\SerieCollection;
use App\Http\Resources\SerieResource;
use App\Models\GenerarKeyApi;
use App\Models\Serie;
use Illuminate\Http\Request;

class SerieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Obtener la clave API del parámetro
        $apiKey = $request->query('api_key');
        $apiKeyExists = GenerarKeyApi::ValidarKeyApi($apiKey)->exists();

        // Si la clave API no existe, devolver un mensaje de error con el código de estado 401
        if (!$apiKeyExists) {
            return response()->json([
                'error' => 'No autorizado',
                'message' => 'La clave API proporcionada no es válida.'
            ], 401);
        }

        // Obtener los parámetros limit y offset de la URL
        $limit = $request->query('limit', 10);
        $offset = $request->query('offset', 0);

        // Obtener los comités con los parámetros de limit y offset
        $serie = Serie::where('estado', 'Publicado')
            ->orderBy('id', 'asc')
            ->offset($offset)
            ->limit($limit)
            ->get();

        return new SerieCollection($serie);
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

        // Obtener el comité por ID
        $serie = Serie::find($id);

        // Si no se encuentra el comité, devolver un mensaje de error con el código de estado 404
        if (!$serie) {
            return response()->json([
                'error' => 'No encontrado',
                'message' => 'La serie solicitada no existe.'
            ], 404);
        }

        return new SerieResource($serie);
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
}