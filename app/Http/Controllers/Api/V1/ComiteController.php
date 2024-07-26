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
    public function index()
    {
        $comites = Comite::orderBy('id', 'asc')->paginate(10);
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

        $comite = Comite::with('series', 'podcasts', 'publicaciones')->find($comiteId);

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
