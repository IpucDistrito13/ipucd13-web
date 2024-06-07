<?php

namespace App\Http\Controllers\Web\Public;

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
            $key = 'publicacionesPage' . request()->page;
        } else {
            $key = 'publicacionesPage';
        }

        if (Cache::has('publicacionesPage')) {
            $publicaciones = Cache::get('publicacionesPage');
        } else {
            $publicaciones = Publicacion::ListarPublicacionesPaginacion();
            Cache::put($key, $publicaciones);

            /*
            $publicaciones = Publicacion::where('estado', 'Publicado')
                ->latest('id')
                ->paginate(8);
            Cache::put($key, $publicaciones);
            */
        }

        $metaData = [
            'title' => 'Publicaciones | IPUC D13',
            'author' => 'IPUC D13',
            'description' => '',
        ];

        return view('public.publicaciones.index', [
            'comites' => $comitesMenu,
            'publicaciones' => $publicaciones,
            'metaData' => $metaData,

            'facebook' => $facebookLink,
            'youtube' => $youtubeLink,
            'instagram' => $instagramLink,
        ]);
    }

    public function show(Publicacion $publicacion)
    {
        //$etiquetas = Etiqueta::all();
        $comites = Comite::SeccionComites()->get();
        $redes_sociales = Redes::Activo()->get();
        $similares = Publicacion::GetSimilaresCategoria($publicacion->categoria_id)->get();

        $metaData = [
            'title' => 'Publicaciones | IPUC D13',
            'author' => 'IPUC D13',
            'description' => '',
        ];

        return view('public.publicaciones.show', [
            'publicacion' => $publicacion,
            'similares' => $similares,
            'comites' => $comites,
            'redes_sociales' => $redes_sociales,
            'metaData' => $metaData,
        ]);
    }
}
