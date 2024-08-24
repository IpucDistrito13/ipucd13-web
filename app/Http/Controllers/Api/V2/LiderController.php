<?php

namespace App\Http\Controllers\Api\V2;

use App\Http\Controllers\Controller;
use App\Http\Resources\LiderCollection;
use Illuminate\Http\Request;
use App\Models\GenerarKeyApi;
use App\Models\Lider;

class LiderController extends Controller
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

    public function getLideresByComite(Request $request, $comiteId)
    {
        //return 'podcast by comite';
        // Obtener la clave API del parámetro
        $apiKey = $request->query('api_key');

        // Verificar la clave API
        $apiKeyResponse = $this->verificaApiKey($apiKey);
        if ($apiKeyResponse !== true) {
            return $apiKeyResponse;
        }

        //return $request;
        // Obtener los parámetros limit y offset de la URL
        $limit = $request->query('limit', 10);
        $offset = $request->query('offset', 0);

        //return Lider::all();

        $lideres = Lider::where('comite_id', $comiteId)
            ->where('estado', 'Activo')
            ->orderBy('id', 'desc')
            ->offset($offset)
            ->limit($limit)
            ->get();

        return new LiderCollection($lideres);

    }

    public function verificaApiKey($apiKey)
    {
        $apiKeyExists = GenerarKeyApi::ValidarKeyApi($apiKey)->exists();

        if (!$apiKeyExists) {
            return response()->json([
                'error' => 'No autorizado',
                'message' => 'La clave API proporcionada no es válida.'
            ], 401);
        }

        return true; // Si la clave API es válida, retornar true.
    }
}
