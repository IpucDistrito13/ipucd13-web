<?php

namespace App\Http\Controllers\Web\Public;

use App\Http\Controllers\Controller;
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

        //MOSTRAR LAS ULTIMAS 10 SERIES SEGUN EL COMITE
        $comites = Comite::all();

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
        

        $series = Serie::PublicShowSerie($comite->id)->get();

        $podcasts = Podcast::where('comite_id', $comite->id)
        ->orderBy('created_at', 'desc')
        ->take(10)
        ->get();


        //return $publicaciones = Publicacion::where('comite_id', $comite->id)->get();


        //return   $series = Serie::all();
        $publicaciones = Publicacion::where('estado', 'Publicado')
            ->where('comite_id', $comite->id)
            ->latest() // Ordenar por la columna 'created_at' de forma descendente
            ->limit(10)  // Limitar a 4 resultados
            ->get();    // Obtener los resultados

        

        $metaData = [
            'title' => 'Comité | IPUC D13',
            'author' => 'IPUC D13',
            'description' => 'Distrito 13 | Cronograma',
        ];       

        return view('public.comites.show', [
            'comites' => $comites,
            'comite' => $comite,
            'publicaciones' => $publicaciones,

            'series' => $series,
            'podcasts' => $podcasts,

            'facebook' => $facebookLink,
            'youtube' => $youtubeLink,
            'instagram' => $instagramLink,

            'cantidadPublicaciones' => $publicaciones->count(),
            'cantidadRedesSociales' => $redes_sociales->count(),

            'metaData' => $metaData,
        ]);

    }
}
