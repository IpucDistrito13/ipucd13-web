<?php

namespace App\Http\Controllers\Api\V2;

use App\Http\Controllers\Controller;
//use App\Http\Resources\V2\collection\VideoCollection;
use App\http\Resources\V2\Collection\VideoCollection;
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
