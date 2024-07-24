<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\InformeCollection;
use App\Models\Publicacion;
use Illuminate\Http\Request;

class InformesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $informes = Publicacion::ListarInformesPaginacion();
        $informeData = new  InformeCollection($informes);

        // Crear la respuesta personalizada sin los campos 'links' y'meta'
        $response = [
            'data' => $informeData,
            'total' => $informes->total(),
            'per_page' => $informes->perPage(),
            'current_page' => $informes->currentPage(),
        ];
        return response()->json($response);
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
}
