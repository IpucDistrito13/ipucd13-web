<?php

namespace App\Http\Controllers\Web\Public;

use App\Constants\CacheKeys;
use App\Http\Controllers\Controller;
use App\Models\Archivo;
use App\Models\Carpeta;
use App\Models\Comite;
use App\Models\Redes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class DescargableController extends Controller
{
    public function index()
    {
        $metaData = [
            'titulo' => 'Descargable | IPUC Distrito 13',
            'autor' => 'IPUC Distrito 13',
            'description' => 'Descargable | IPUC Distrito 13',
        ];

        $comites = Comite::select('id', 'nombre', 'slug')->get();

        /*
        $comitesMenu = Cache::remember(CacheKeys::PUBLIC_COMITES_MENU, null, function () {
            return Comite::ComiteMenu()->get();
        });
        */

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

        return view('public.descargables.index', [
            'comites' => $comites,
            'metaData' => $metaData,
            'transmision' => $socialData['transmision'],
            'facebook' => $socialData['links']['facebook'],
            'youtube' => $socialData['links']['youtube'],
            'instagram' => $socialData['links']['instagram'],
        ]);
    }

    public function comite(Comite $comite)
    {
        $metaData = [
            'titulo' => 'Descargable | IPUC Distrito 13',
            'autor' => 'IPUC Distrito 13',
            'description' => 'Descargable | IPUC Distrito 13',
        ];

        $carpetas = Cache::remember(CacheKeys::PUBLIC_CARPETAS . $comite, null, function () use ($comite) {
            return Carpeta::PorComitePublico($comite->id)->with('archivos')->get();
        });

        $comitesMenu = Cache::remember(CacheKeys::PUBLIC_COMITES_MENU, null, function () {
            return Comite::ComiteMenu()->get();
        });

        $socialData = Cache::remember(CacheKeys::PUBLIC_SOCIAL_DATA, null, function () {
            $redes_sociales = Redes::Activo()->get();
            $data = [
                'links' => ['facebook' => '', 'youtube' => '', 'instagram' => '']
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

        return view('public.descargables.comite', [
            'comites' => $comitesMenu,
            'comite' => $comite,
            'carpetas' => $carpetas,
            'metaData' => $metaData,
            'transmision' => $socialData['transmision'],
            'facebook' => $socialData['links']['facebook'],
            'youtube' => $socialData['links']['youtube'],
            'instagram' => $socialData['links']['instagram'],
        ]);
    }

    public function download($id)
    {
        //return $id;
        try {
            // Buscar el archivo en la base de datos usando el UUID
            $archivo = Archivo::where('id', $id)->first();

            // Verificar si se encontró el archivo
            if ($archivo) {
                // Obtener la URL del archivo
                $filePath = $archivo->url;

                // Verificar si el archivo existe en el sistema de archivos
                if (Storage::exists($filePath)) {
                    // Descargar el archivo
                    return Storage::download($filePath, $archivo->nombre_original);
                } else {
                    // Manejar el caso en el que el archivo no existe en el sistema de archivos
                    return response()->json(['error' => 'El archivo no existe en el sistema de archivos'], 404);
                }
            } else {
                // Manejar el caso en el que no se encuentre el archivo en la base de datos
                return response()->json(['error' => 'Archivo no encontrado'], 404);
            }
        } catch (\Exception $e) {
            // Manejar errores generales y devolver una respuesta con el mensaje de error
            return response()->json(['error' => 'Error al descargar el archivo: ' . $e->getMessage()], 500);
        }
    }
}
