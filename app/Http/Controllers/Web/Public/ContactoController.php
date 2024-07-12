<?php

namespace App\Http\Controllers\Web\Public;

use App\Http\Controllers\Controller;
use App\Models\Comite;
use App\Models\Redes;
use Illuminate\Http\Request;

class ContactoController extends Controller
{
    public function index()
    {
        $metaData = [
            'title' => 'Contacto | IPUC Distrito 13',
            'autor' => 'IPUC Distrito 13',
            'description' => 'Contacto | IPUC Distrito 13',
        ];

        $comitesMenu = Comite::ComiteMenu()->get();

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

        return view('public.contacto.index', [
            'comites' => $comitesMenu,
            'metaData' => $metaData,

            'transmision' => $transmision,
            'facebook' => $facebookLink,
            'youtube' => $youtubeLink,
            'instagram' => $instagramLink,
        ]);
    }
}
