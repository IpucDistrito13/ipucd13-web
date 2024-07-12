<?php

namespace App\Http\Controllers\Web\Public;

use App\Http\Controllers\Controller;
use App\Models\Archivo;
use App\Models\Carpeta;
use App\Models\Comite;
use App\Models\Redes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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

        return view('public.descargables.index', [
            'comites' => $comitesMenu,
            'metaData' => $metaData,

            'transmision' => $transmision,
            'facebook' => $facebookLink,
            'youtube' => $youtubeLink,
            'instagram' => $instagramLink,
        ]);
    }

    public function comite($comiteId)
    {
        $comite = Comite::GetComite($comiteId)->first();
        $carpetas = Carpeta::PorComitePublico($comiteId)->with('archivos')->get();
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

        return view('public.descargables.comite', [
            'comites' => $comitesMenu,
            'comite' => $comite,
            'carpetas' => $carpetas,
            'metaData' => $metaData,

            'facebook' => $facebookLink,
            'youtube' => $youtubeLink,
            'instagram' => $instagramLink,
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
