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
        $comites = Comite::all();
        $metaData = [
            'titulo' => 'Descargable | IPUC D13',
            'autor' => 'IPUC D13',
            'description' => '',
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
            'comites' => $comites,
            'metaData' => $metaData,

            'facebook' => $facebookLink,
            'youtube' => $youtubeLink,
            'instagram' => $instagramLink,
        ]);
    }
}
