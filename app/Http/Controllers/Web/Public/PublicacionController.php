<?php

namespace App\Http\Controllers\Web\Public;

use App\Constants\CacheKeys;
use App\Http\Controllers\Controller;
use App\Models\Comite;
use App\Models\Publicacion;
use App\Models\Redes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class PublicacionController extends Controller
{
    public function index()
    {
        // Meta data
        $metaData = [
            'title' => 'Publicaciones | IPUC D13',
            'author' => 'IPUC Distrito 13',
            'description' => 'Publicaciones | IPUC D13',
        ];

        // Obtener menú de comités del caché
        $comitesMenu = Cache::remember(CacheKeys::PUBLIC_COMITES_MENU, null, function () {
            return Comite::ComiteMenu()->get();
        });

        // Obtener publicaciones del caché con paginación
        $pageKey = CacheKeys::PUBLIC_PUBLICACION . (request()->page ?: 1);
        $publicaciones = Cache::remember($pageKey, null, function () {
            return Publicacion::ListarPublicacionesPaginacion();
        });

        // Obtener redes sociales y transmisión del caché
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

        // Renderizar la vista con los datos obtenidos
        return view('public.publicaciones.index', [
            'comites' => $comitesMenu,
            'publicaciones' => $publicaciones,
            'metaData' => $metaData,
            'transmision' => $socialData['transmision'],
            'facebook' => $socialData['links']['facebook'],
            'youtube' => $socialData['links']['youtube'],
            'instagram' => $socialData['links']['instagram'],
        ]);
    }

    public function show(Publicacion $publicacion)
    {
        $comites = Cache::remember(CacheKeys::PUBLIC_COMITES, null, function () {
            return Comite::SeccionComites()->get();
        });

        $redes_sociales = Cache::remember(CacheKeys::PUBLIC_SOCIAL_DATA, null, function () {
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

        $similares = Cache::remember(CacheKeys::PUBLIC_SIMILARES_CATEGORIA . $publicacion->categoria_id, null, function () use ($publicacion) {
            return Publicacion::GetSimilaresCategoria($publicacion->categoria_id)->get();
        });

        $metaData = [
            'title' => 'Publicaciones | IPUC D13',
            'author' => 'IPUC Distrito 13',
            'description' => 'Publicaciones | IPUC D13',
        ];

        return view('public.publicaciones.show', [
            'publicacion' => $publicacion,
            'similares' => $similares,
            'comites' => $comites,
            'redes_sociales' => $redes_sociales,
            'metaData' => $metaData,
            'transmision' => $redes_sociales['transmision'],
            'facebook' => $redes_sociales['links']['facebook'],
            'youtube' => $redes_sociales['links']['youtube'],
            'instagram' => $redes_sociales['links']['instagram'],
        ]);
    }
}
