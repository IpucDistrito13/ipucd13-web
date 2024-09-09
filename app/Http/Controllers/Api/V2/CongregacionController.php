<?php

namespace App\Http\Controllers\Api\V2;

use App\Http\Controllers\Controller;
use App\Http\Resources\V2\Collection\CongregacionCollection as CollectionCongregacionCollection;
use App\Http\Resources\V2\Resource\CongregacionCollection;
use App\Models\Congregacion;
use App\Models\GenerarKeyApi;
use Illuminate\Http\Request;

class CongregacionController extends Controller
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

        $congregaciones = Congregacion::where('estado', 'Activo')
            ->offset($offset)
            ->limit($limit)
            ->get();
        return  new CollectionCongregacionCollection($congregaciones);
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
    public function show(string $id)
    {
        //
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


    public function search(Request $request)
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
 

        $query = $request->input('query');
        $limit = $request->input('limit', 10);  // valor por defecto es 10
        $offset = $request->input('offset', 0); // valor por defecto es 0
    
        if (!$query) {
            return response()->json([
                'error' => 'Debe proporcionar un término de búsqueda.'
            ], 400);
        }
    
        $congregaciones = Congregacion::where('nombre', 'like', "%{$query}%")
            ->skip($offset)
            ->take($limit)
            ->get();
    
        if ($congregaciones->isEmpty()) {
            return response()->json([
                'message' => 'No se encontraron resultados.'
            ], 404);
        }
    
        return new CollectionCongregacionCollection($congregaciones);
    }
    
}
