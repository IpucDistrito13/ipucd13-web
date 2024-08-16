<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\ComiteCollection;
use App\Http\Resources\ComiteResource;
use App\Models\Comite;
use Illuminate\Http\Request;

class ComiteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    /*
    public function index()
    {
        $comites = Comite::orderBy('id', 'asc')->paginate(10);
        return new ComiteCollection($comites);
    }
    */

    
    
    public function index(Request $request)
{
    // Obtener la clave API del parámetro
    $apiKey = $request->query('api_key');

    // Verificar la clave API (esto es solo un ejemplo, personaliza según tus necesidades)
    if ($apiKey !== 'test') {
        return response()->json(['error' => 'Unauthorized'], 401);
    }

    // Obtener los parámetros limit y offset de la URL
    $limit = $request->query('limit', 10); // valor por defecto de 10 si no se proporciona
    $offset = $request->query('offset', 0); // valor por defecto de 0 si no se proporciona

    // Obtener los comités con los parámetros de limit y offset
    $comites = Comite::orderBy('id', 'asc')
                    ->offset($offset)
                    ->limit($limit)
                    ->get();

    // Retornar la colección de recursos
    //return ComiteResource::collection($comites);
    return new ComiteCollection($comites);
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
    public function show($comiteId)
    {

        $comite = Comite::with('lideres', 'series', 'podcasts', 'publicaciones')
            ->find($comiteId);

        if (!$comite) {
            return response()->json([
                'message' => 'Comité no encontrado.'
            ], 404);
        }

        // Return the comite data as JSON
        return new ComiteResource($comite);
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
