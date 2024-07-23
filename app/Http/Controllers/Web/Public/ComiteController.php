<?php

namespace App\Http\Controllers\Web\Public;

use App\Constants\CacheKeys;
use App\Http\Controllers\Controller;
use App\Models\Carpeta;
use App\Models\Comite;
use App\Models\Lider;
use App\Models\Podcast;
use App\Models\Publicacion;
use App\Models\Redes;
use App\Models\Serie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ComiteController extends Controller
{

    public function show(Comite $comite)
    {
        $comitesMenu = Cache::remember(CacheKeys::PUBLIC_COMITES_MENU, null, function () {
            return Comite::ComiteMenu()->get();
        });

        $carpetas = Cache::remember(CacheKeys::PUBLIC_CARPETAS . $comite->id, null, function () use ($comite) {
            return Carpeta::PorComitePublico($comite->id)->with('archivos')->get();
        });

        $lideres = Cache::remember(CacheKeys::PUBLIC_LIDERES . $comite->id, null, function () use ($comite) {
            return Lider::LideresPorComite($comite->id)->get();
        });

        $series = Cache::remember(CacheKeys::PUBLIC_SERIES . $comite->id, null, function () use ($comite) {
            return Serie::GetUltimasSeries($comite->id)->get();
        });

        $podcasts = Cache::remember(CacheKeys::PUBLIC_PODCAST . $comite->id, null, function () use ($comite) {
            return Podcast::GetUltimosPodcastComite($comite->id)->get();
        });

        $publicaciones = Cache::remember(CacheKeys::PUBLIC_PUBLICACIONES . $comite->id, null, function () use ($comite) {
            return Publicacion::GetUltimasPublicaciones($comite->id)->get();
        });

        $socialData = Cache::remember(CacheKeys::PUBLIC_SOCIAL_DATA, null, function () {
            $redes_sociales = Redes::Activo()->get();
            $data = [
                'links' => ['facebook' => '', 'youtube' => '', 'instagram' => ''],
                'transmision' => Redes::GetTransmision()->first(),
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
            'title' => 'Comité | IPUC Distrito 13',
            'author' => 'IPUC Distrito 13',
            'description' => 'Comité | IPUC Distrito 13',
        ];

        return view('public.comites.show', [
            'comites' => $comitesMenu,
            'comite' => $comite,
            'publicaciones' => $publicaciones,
            'carpetas' => $carpetas,
            'lideres' => $lideres,
            'series' => $series,
            'podcasts' => $podcasts,
            'transmision' => $socialData['transmision'],
            'facebook' => $socialData['links']['facebook'],
            'youtube' => $socialData['links']['youtube'],
            'instagram' => $socialData['links']['instagram'],
            'metaData' => $metaData,
        ]);
    }
}
