<?php

namespace App\Http\Controllers\Api\V2;

use App\Http\Controllers\Controller;
use App\Http\Resources\EpisodioCollection;
use App\Models\Episodio;
use Illuminate\Http\Request;

class EpisodioController extends Controller
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

    public function getEpisodiosByPodcast(Request $request, $podcastId)
    {
        $limit = $request->input('limit', 10);
        $offset = $request->input('offset', 0);


        $episodios = Episodio::with('podcast')->where('podcast_id', $podcastId)
        ->orderBy('updated_at', 'desc')
            ->offset($offset)
            ->limit($limit)
            ->get();

            return new EpisodioCollection($episodios);
    }
}
