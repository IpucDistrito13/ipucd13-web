<?php

namespace App\Http\Controllers\Web\Public;

use App\Constants\CacheKeys;
use App\Http\Controllers\Controller;
use App\Models\Comite;
use App\Models\Episodio;
use App\Models\Podcast;
use App\Models\Redes;
use Illuminate\Support\Facades\Cache;


class PodcastController extends Controller
{
    public function index()
    {
        $metaData = [
            'title' => 'Podcasts | IPUC D13',
            'author' => 'IPUC Distrito 13',
            'description' => 'Podcasts | IPUC D13',
        ];

        $comitesMenu = Cache::remember(CacheKeys::PUBLIC_COMITES_MENU, null, function () {
            return Comite::ComiteMenu()->get();
        });

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

        $page = request()->get('page', 1);
        $podcasts = Cache::remember(CacheKeys::PUBLIC_PODCASTS_PAGE . $page, null, function () {
            return Podcast::ListarPodcastsPaginacion();
        });

        return view('public.podcasts.index', [
            'comites' => $comitesMenu,
            'podcasts' => $podcasts,
            'metaData' => $metaData,
            'transmision' => $socialData['transmision'],
            'facebook' => $socialData['links']['facebook'],
            'youtube' => $socialData['links']['youtube'],
            'instagram' => $socialData['links']['instagram'],
        ]);
    }

    public function episodios(Podcast $podcast)
    {
        
        //return $podcast;
         $cacheEpisodio = CacheKeys::PUBLIC_PODCAST . $podcast->id;

        $metaData = [
            'title' => 'Podcasts | IPUC D13',
            'author' => 'IPUC Distrito 13',
            'description' => 'Podcasts | IPUC D13',
        ];

        $comitesMenu = Cache::remember(CacheKeys::PUBLIC_COMITES_MENU, null, function () {
            return Comite::ComiteMenu()->get();
        });

        $episodios = Cache::remember($cacheEpisodio, null, function () use ($podcast) {
            return  Episodio::where('podcast_id', $podcast->id)->get();
           
        });

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

        return view('public.podcasts.episodios', [
            'comites' => $comitesMenu,
            'podcast' => $podcast,
            'metaData' => $metaData,
            'episodios' => $episodios,
            'transmision' => $socialData['transmision'],
            'facebook' => $socialData['links']['facebook'],
            'youtube' => $socialData['links']['youtube'],
            'instagram' => $socialData['links']['instagram'],
        ]);


        /*
        $metaData = [
            'title' => 'Podcasts | IPUC D13',
            'author' => 'IPUC Distrito 13',
            'description' => 'Podcasts | IPUC D13',
        ];

        $comitesMenu = Cache::remember(CacheKeys::PUBLIC_COMITES_MENU, null, function () {
            return Comite::ComiteMenu()->get();
        });

        $episodios = Cache::remember($cacheEpisodio, null, function () use ($podcast) {
            return  Episodio::where('podcast_id', $podcast->id)->get();
           
        });

        

        return view('public.podcasts.episodios', [
            'comites' => $comitesMenu,
            'podcast' => $podcast,
            'metaData' => $metaData,
            'episodios' => $episodios,
            'transmision' => $socialData['transmision'],
            'facebook' => $socialData['links']['facebook'],
            'youtube' => $socialData['links']['youtube'],
            'instagram' => $socialData['links']['instagram'],
        ]);
*/
    }

    public function episodios2(Podcast $podcast)
    {
        $cacheKey = CacheKeys::PUBLIC_PODCAST . $podcast->id;
    }

    public function apigetAudio($episodioid)
    {
        $audio = Episodio::select('id', 'url', 'titulo')->where('id', $episodioid)->first();
        return $audio;
    }
}
