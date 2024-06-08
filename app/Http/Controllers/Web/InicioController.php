<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Comite;
use App\Models\Congregacion;
use App\Models\Departamento;
use App\Models\Municipio;
use App\Models\Publicacion;
use App\Models\Redes;
use Illuminate\Http\Request;

class InicioController extends Controller
{
    public function index()
    {
        $comites = Comite::all();
        $congregaciones = Congregacion::select('id')->get();
        $municipios = Municipio::select('id')->get();
        $departamentos = Departamento::select('id')->get();

        $redes_sociales = Redes::Activo()->get();
        $transmision = Redes::GetTransmision()->first();
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

        //return $instagramLink;

        $metaData = [
            'titulo' => 'Inicio | IPUC Distrito 13',
            'autor' => 'IPUC Distrito 13',
            'description' => 'Inicio | IPUC Distrito 13',
        ];

        $publicaciones = Publicacion::GetPublicoShowPublicaciones();
        return view('public.inicio', [
            'transmision' => $transmision,
            'comites' => $comites,

            'publicaciones' => $publicaciones,
            
            'facebook' => $facebookLink,
            'youtube' => $youtubeLink,
            'instagram' => $instagramLink,

            'cantidadDepartamentos' => $departamentos->count(),
            'cantidadMunicipios' => $municipios->count(),
            'cantidadCongregaciones' => $congregaciones->count(),
            'metaData' => $metaData

        ]);
    }
}
