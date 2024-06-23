<?php

namespace App\Http\Controllers\Web\Public;

use App\Http\Controllers\Controller;
use App\Models\Comite;
use App\Models\Redes;
use App\Models\Serie;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;


class SerieController extends Controller
{
    public function index()
    {
        $comitesMenu = Comite::ComiteMenu()->get();

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

        //PAGINACION POR CACHE
        if (request()->page) {
            $key = 'seriesPage' . request()->page;
        } else {
            $key = 'seriesPage';
        }

        if (Cache::has('seriesPage')) {
            $series = Cache::get('seriesPage');
        } else {
            $series = Serie::ListarSeriesPaginacion();
            Cache::put($key, $series);
        }

        $metaData = [
            'title' => 'Series | IPUC D13',
            'author' => 'IPUC Distrito 13',
            'description' => 'Series | IPUC D13',
        ];

        return view('public.series.index', [
            'comites' => $comitesMenu,
            'series' => $series,
            'metaData' => $metaData,

            'facebook' => $facebookLink,
            'youtube' => $youtubeLink,
            'instagram' => $instagramLink,
        ]);
    }

    public function show(Serie $serie)
    {

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
