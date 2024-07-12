<?php

namespace App\Http\Controllers\Web\Public;

use App\Http\Controllers\Controller;
use App\Models\Carpeta;
use App\Models\Comite;
use App\Models\Podcast;
use App\Models\Publicacion;
use App\Models\Redes;
use App\Models\Serie;
use Illuminate\Http\Request;

class ComiteController extends Controller
{
    public function show(Comite $comite)
    {

        $comitesMenu = Comite::ComiteMenu()->get();
        $carpetas = Carpeta::PorComitePublico($comite->id)->with('archivos')->get();

        //REDES
        $redes_sociales = Redes::Activo()->get();
        $facebookLink = '';
        $youtubeLink = '';
        $instagramLink = '';
        $transmision = Redes::GetTransmision()->first();

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

        $series = Serie::GetUltimasSeries($comite->id)->get();
      //return  $podcasts = Podcast::all();
        $podcasts = Podcast::GetUltimosPodcastComite($comite->id)->get();

        $publicaciones = Publicacion::GetUltimasPublicaciones($comite->id)->get();

        $metaData = [
            'title' => 'Comité | IPUC Distrito 13',
            'author' => 'IPUC Distrito 13',
            'description' => 'Comité | IPUC Distrito 13',
        ];

        //return $comite;

        return view('public.comites.show', [
            'comites' => $comitesMenu,
            'comite' => $comite,
            'publicaciones' => $publicaciones,
            'carpetas' => $carpetas,

            'series' => $series,
            'podcasts' => $podcasts,

            'transmision' => $transmision,
            'facebook' => $facebookLink,
            'youtube' => $youtubeLink,
            'instagram' => $instagramLink,

            'cantidadPublicaciones' => $publicaciones->count(),
            'cantidadRedesSociales' => $redes_sociales->count(),

            'metaData' => $metaData,
        ]);
    }
}
