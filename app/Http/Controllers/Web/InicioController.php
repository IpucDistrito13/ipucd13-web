<?php

namespace App\Http\Controllers\Web;

use App\Constants\CacheKeys;
use App\Http\Controllers\Controller;
use App\Models\Comite;
use App\Models\Congregacion;
use App\Models\Departamento;
use App\Models\Municipio;
use App\Models\Publicacion;
use App\Models\Redes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class InicioController extends Controller
{
    public function index()
    {
        /*
        $comites = Comite::all();
        $congregaciones = Congregacion::select('id')->get();
        $municipios = Municipio::select('id')->get();
        $departamentos = Departamento::select('id')->get();

        $redes_sociales = Redes::Activo()->get();
        $transmision = Redes::GetTransmision()->first();
        */
        $comitesMenu = Cache::remember(CacheKeys::PUBLIC_COMITES_MENU, null, function () {
            return Comite::ComiteMenu()->get();
        });

        $congregaciones = Cache::remember(CacheKeys::PUBLIC_CONGREGACIONES, null, function () {
            return Congregacion::all();
        });

        $municipios = Cache::remember(CacheKeys::PUBLIC_MUNICIPIOS, null, function () {
            return Municipio::select('id')->get();
        });

        $departamentos = Cache::remember(CacheKeys::PUBLIC_DEPARTAMENTOS, null, function () {
            return Departamento::select('id')->get();
        });

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

                if ($redSocial['transmision']) {
                    $data['transmision'] = $redSocial;
                }
            }

            return $data;
        });

        $metaData = [
            'titulo' => 'Inicio | IPUC Distrito 13',
            'autor' => 'IPUC Distrito 13',
            'description' => 'Inicio | IPUC Distrito 13',
        ];

        $publicaciones = Cache::remember(CacheKeys::PUBLIC_PUBLICACIONES, null, function () {
            return Publicacion::GetPublicoShowPublicaciones();
        });

        return view('public.inicio', [
            'transmision' => $socialData['transmision'],
            'comites' => $comitesMenu,
            'publicaciones' => $publicaciones,
            'facebook' => $socialData['links']['facebook'],
            'youtube' => $socialData['links']['youtube'],
            'instagram' => $socialData['links']['instagram'],
            'cantidadDepartamentos' => $departamentos->count(),
            'cantidadMunicipios' => $municipios->count(),
            'cantidadCongregaciones' => $congregaciones->count(),
            'metaData' => $metaData
        ]);
    }
}
