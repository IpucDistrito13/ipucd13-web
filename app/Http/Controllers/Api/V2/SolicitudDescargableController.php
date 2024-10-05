<?php

namespace App\Http\Controllers\Api\V2;

use App\Http\Controllers\Controller;
use App\Http\Resources\V2\Collection\SolicitudDescargableCollection;
use App\Models\SolicitudDescargable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;


class SolicitudDescargableController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $solicitudesDescargable = SolicitudDescargable::where('estado', 'Activo')->get();
        return new  SolicitudDescargableCollection($solicitudesDescargable);
    }

    public function download($uuid)
    {
        try {
            // Buscar el archivo en la base de datos usando el UUID
            $archivo = SolicitudDescargable::select('uuid', 'url',  'nombre_original')->where('uuid', $uuid)->first();

            // Verificar si se encontró el archivo
            if ($archivo) {
                // Obtener la URL del archivo
                $filePath = $archivo->url;

                // Verificar si el archivo existe en el sistema de archivos
                if (Storage::exists($filePath)) {

                    // Obtener el nombre del archivo desde la URL o ruta
                    $fileName = basename($filePath);

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

            Log::error('Error en download - SolicitudDescargable: ' . $e->getMessage());

            return response()->json(['error' => 'Error al descargar el archivo: ' . $e->getMessage()], 500);
        }
    }

    /*
    public function getArchivosSolicitudDescargable(Request $request, $slug)
    {
       return $solicitudDescargable = SolicitudDescargable::where('slug', $slug)->first();
        if ($solicitudDescargable) {
            $archivos = $solicitudDescargable->archivos;
            return response()->json($archivos, 200);
        } else {
            return response()->json(['message' => 'La solicitud de descargable no existe'], 404);
        }
    }
    */
}
