<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\PodcastCollection;
use App\Http\Resources\PodcastResource;
use App\Models\Podcast;
use Illuminate\Http\Request;

class PodcastController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $podcasts = Podcast::ListarPodcastsPaginacion();
        $podcastData = new  PodcastCollection($podcasts);

        $response = [
            'data' => $podcastData,
            'total' => $podcasts->total(),
            'per_page' => $podcasts->perPage(),
            'current_page' => $podcasts->currentPage(),
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
    public function show($podcastId)
    {
        $podcast = Podcast::with(['comite', 'categoria', 'episodios'])
        ->findOrFail($podcastId);
        
        if (!$podcast) {
            return response()->json([
                'message' => 'Podcast no encontrado.'
            ], 404);
        }

        return new PodcastResource($podcast);
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
