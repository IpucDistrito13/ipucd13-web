<?php

namespace App\Http\Controllers\Web\Public;

use App\Http\Controllers\Controller;
use App\Models\Comite;
use App\Models\Episodio;
use App\Models\Podcast;
use App\Models\Redes;
use Illuminate\Http\Request;

class PodcastController extends Controller
{
    public function index()
    {
        $podcasts = Podcast::all();
        //return $podcasts;
       // return view('public.podcasts.index', compact('podcasts'));
    }

    public function show(Podcast $podcast)
    {
        return $podcast;
    }

    public function episodios(Podcast $podcast)
    {
       // return $podcast;
       $metaData = [
        'title' => 'Cronogramas | IPUC D13',
        'author' => 'IPUC Distrito 13',
        'description' => 'Cronogramas | IPUC D13',
    ];

     //REDES
     $redes_sociales = Redes::Activo()->get();
     $facebookLink = '';
     $youtubeLink = '';
     $instagramLink = '';
     // Itera sobre la lista para encontrar Facebook
     foreach ($redes_sociales as $redSocial) {
         switch ($redSocial["nombre"]) {
             case "Facebook":
                 $facebookLink = $redSocial["url"];
                 break;
             case "YouTube":
                 $youtubeLink = $redSocial["url"];
                 break;
             case "Instagram":
                 $instagramLink = $redSocial["url"];
                 break;
         }
     }
     // REDES

    $comites = Comite::all();

        return view('public.podcasts.episodios', [
            'comites' => $comites,
            'podcast' => $podcast,
           'metaData' => $metaData,

           'facebook' => $facebookLink,
           'youtube' => $youtubeLink,
           'instagram' => $instagramLink,

        ]);


    }

    /*
    public function listEpisodio(Podcast $podcast)
    {
        return view('public.podcasts.episodios', [
            'podcast' => $podcast,
        ]);
    }
    */

    public function apigetAudio($episodioid)
    {
        $audio = Episodio::select('id', 'url', 'titulo')->where('id', $episodioid)->first();
        return $audio;
    }
}
