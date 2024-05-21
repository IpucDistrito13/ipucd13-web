<?php

namespace App\Http\Controllers\Web\Public;

use App\Http\Controllers\Controller;
use App\Models\Comite;
use App\Models\Serie;
use App\Models\Video;
use Illuminate\Http\Request;

class SerieController extends Controller
{
    public function show(Serie $serie)
    {

        //return $serie;

        $comites = Comite::all();
        $videos = Video::where('serie_id', $serie->id)->get();

        $metaData = [
            'title' => 'Serie | IPUC D13',
            'author' => 'IPUC D13',
            'description' => 'Distrito 13 | Cronograma',
        ];

        return view('public.videos.show', compact('serie', 'videos', 'comites', 'metaData'));
    }
}
