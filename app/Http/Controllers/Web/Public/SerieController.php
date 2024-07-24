<?php

namespace App\Http\Controllers\Web\Public;

use App\Constants\CacheKeys;
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
        // Cache comites menu
        $comitesMenu = Cache::remember(CacheKeys::PUBLIC_COMITES_MENU, null, function () {
            return Comite::ComiteMenu()->get();
        });

        // Cache social media data
        $socialData = Cache::remember(CacheKeys::PUBLIC_SOCIAL_DATA, null, function () {
            $redes_sociales = Redes::Activo()->get();
            $data = [
                'links' => ['facebook' => '', 'youtube' => '', 'instagram' => ''],
                'transmision' => Redes::GetTransmision()->first()
            ];

            foreach ($redes_sociales as $redSocial) {
                switch ($redSocial["nombre"]) {
                    case "Facebook":
                        $data['links']['facebook'] = $redSocial["url"];
                        break;
                    case "YouTube":
                        $data['links']['youtube'] = $redSocial["url"];
                        break;
                    case "Instagram":
                        $data['links']['instagram'] = $redSocial["url"];
                        break;
                }
            }

            return $data;
        });

        // Cache series with pagination
        $page = request()->get('page', 1);
        $seriesKey = CacheKeys::PUBLIC_SERIES_PAGE . $page;

        $series = Cache::remember($seriesKey, now()->addHours(6), function () {
            return Serie::ListarSeriesPaginacion();
        });

        $metaData = [
            'title' => 'Series | IPUC D13',
            'author' => 'IPUC Distrito 13',
            'description' => 'Series | IPUC D13',
        ];

        return view('public.series.index', [
            'comites' => $comitesMenu,
            'series' => $series,
            'metaData' => $metaData,
            'transmision' => $socialData['transmision'],
            'facebook' => $socialData['links']['facebook'],
            'youtube' => $socialData['links']['youtube'],
            'instagram' => $socialData['links']['instagram'],
        ]);
    }

    public function show(Serie $serie)
    {
        // Cache comites
        $comitesMenu = Cache::remember(CacheKeys::PUBLIC_COMITES_MENU, null, function () {
            return Comite::ComiteMenu()->get();
        });

        // Cache videos for this series
        $videos = Cache::remember(CacheKeys::PUBLIC_VIDEOS_SERIE . $serie->id, null, function () use ($serie) {
            return Video::where('serie_id', $serie->id)->get();
        });

        // Cache social media data
        $socialData = Cache::remember(CacheKeys::PUBLIC_SOCIAL_DATA, null, function () {
            $redes_sociales = Redes::Activo()->get();
            $data = [
                'links' => ['facebook' => '', 'youtube' => '', 'instagram' => ''],
                'transmision' => Redes::GetTransmision()->first()
            ];

            foreach ($redes_sociales as $redSocial) {
                switch ($redSocial["nombre"]) {
                    case "Facebook":
                        $data['links']['facebook'] = $redSocial["url"];
                        break;
                    case "YouTube":
                        $data['links']['youtube'] = $redSocial["url"];
                        break;
                    case "Instagram":
                        $data['links']['instagram'] = $redSocial["url"];
                        break;
                }
            }

            return $data;
        });

        $metaData = [
            'title' => 'Serie | IPUC D13',
            'author' => 'IPUC D13',
            'description' => 'Distrito 13 | Cronograma',
        ];

        return view(
            'public.videos.show',
            [
                'comites' => $comitesMenu,
                'serie' => $serie,
                'videos' => $videos,
                'metaData' => $metaData,
                'transmision' => $socialData['transmision'],
                'facebook' => $socialData['links']['facebook'],
                'youtube' => $socialData['links']['youtube'],
                'instagram' => $socialData['links']['instagram'],
            ]
        );
    }
}
