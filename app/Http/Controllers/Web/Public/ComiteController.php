<?php

namespace App\Http\Controllers\Web\Public;

use App\Http\Controllers\Controller;
use App\Models\Comite;
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

        $series = Serie::ComitesUltimos10($comite);

        //return   $series = Serie::all();
        $publicaciones = Publicacion::where('estado', 'Publicado')
            ->where('comite_id', $comite->id)
            ->latest() // Ordenar por la columna 'created_at' de forma descendente
            ->limit(4)  // Limitar a 4 resultados
            ->get();    // Obtener los resultados

        $redes_sociales = Redes::where('estado', 'Activo')->get();
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
            'facebook' => $facebookLink,
            'youtube' => $youtubeLink,
            'instagram' => $instagramLink,

            'cantidadPublicaciones' => $publicaciones->count(),
            'cantidadRedesSociales' => $redes_sociales->count(),

            'metaData' => $metaData,
        ]);

    }
}
