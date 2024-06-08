<?php

namespace App\Http\Controllers\Web\Public;

use App\Http\Controllers\Controller;
use App\Models\Comite;
use App\Models\Redes;
use Illuminate\Http\Request;

class DescargableController extends Controller
{
    public function index()
    {
        $comitesMenu = Comite::ComiteMenu()->get();
        $metaData = [
            'titulo' => 'Descargable | IPUC Distrito 13',
            'autor' => 'IPUC Distrito 13',
            'description' => 'Descargable | IPUC Distrito 13',
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

        return view('public.descargables.index', [
            'comites' => $comitesMenu,
            'metaData' => $metaData,

            'facebook' => $facebookLink,
            'youtube' => $youtubeLink,
            'instagram' => $instagramLink,
        ]);
    }
}
