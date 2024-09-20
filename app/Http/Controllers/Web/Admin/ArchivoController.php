<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Models\Archivo;
use App\Models\Carpeta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class ArchivoController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index(Carpeta $carpeta)
    {

        $archivos = Archivo::CarpetaPrivadaxArchivo($carpeta->id)->get();

        return view('admin.archivos.index', [
            'carpeta' => $carpeta,
            'archivos' => $archivos,
        ]);
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Archivo $archivo)
    {
        DB::beginTransaction();

        try {

            // Eliminar el banner del podcast, si existe
            if ($archivo->url) {
                $this->deleteFile($archivo->url);
            }

            // Eliminar el archivo
            $archivo->delete();
            Cache::flush();
            DB::commit();

            // Mensaje de éxito
            $data = [
                'message' => 'Archivo eliminado exitosamente.',
            ];

            return back()->with('success', $data['message']);
        } catch (\Exception $e) {
            // Revertir la transacción en caso de error
            DB::rollBack();

            // Registrar el error en los logs
            Log::error('Error en destroy - Archivo: ' . $e->getMessage());

            // Mensaje de error
            $data = [
                'message' => 'No se pudo eliminar el archivo, debido a restricción de integridad.',
            ];

            return back()->with('error', $data['message']);
        }
    }

    private function deleteFile($url)
    {
        // Lógica para eliminar el archivo físico dependiendo del entorno
        if (env('APP_ENV') === 'local') {
            Storage::delete($url); // Eliminar archivo localmente
        } else {
            // Lógica para eliminar el archivo en S3 u otro servicio de almacenamiento en la nube
            Storage::disk('s3')->delete($url);
        }
    }


    private function storeFile($file, $ubicacion)
    {
        if (env('APP_ENV') === 'local') {
            return Storage::put($ubicacion, $file);
        } else {
            return Storage::disk('s3')->put($ubicacion, $file);
        }
    }

    public function upload(Request $request)
    {
        // Validar la solicitud antes de procesarla
        $request->validate([
            'carpeta' => 'required|integer',
            'file' => 'required|file|max:204800' // Máximo 200 MB
        ]);

        // Iniciar transacción de base de datos
        DB::beginTransaction();

        try {
            $uuid = Str::uuid()->toString();

            // Obtener la carpeta desde la solicitud
            $carpeta = $request->carpeta;

            // Obtener el archivo de la solicitud
            $file = $request->file('file');
            $originalName = $file->getClientOriginalName();

            // Determinar la ubicación de almacenamiento según el entorno
            $ubicacion = 'public/descargables/' . $carpeta;

            // Almacenar el archivo utilizando storeFile
            if (env('APP_ENV') === 'local') {
                $url = $this->storeFile($file, $ubicacion);
            } else {
                $url = Storage::disk('s3')->put($ubicacion, $file);
            }

            // Crear una entrada en la base de datos para el archivo cargado
            $archivo = Archivo::create([
                
                'uuid' => $uuid, // Puedes usar esto o generar un UUID único según tu lógica
                'url' => $url,
                'carpeta_id' => $carpeta,
                'user_id' => auth()->id(),
                'nombre_original' => $originalName,
                'tipo' => 'archivo', // Asegúrate de que 'tipo' sea 'enlace'
            ]);

            // Commit de la transacción si no hay errores
            DB::commit();
            Cache::flush();

            // Devolver una respuesta de éxito
            return response()
                ->json(['message' => 'Archivo cargado exitosamente', 'archivo' => $archivo], 200);
        } catch (\Exception $e) {
            // Rollback de la transacción en caso de error
            DB::rollBack();
            Log::error('Error en upload - Archivo: ' . $e->getMessage());

            // En caso de error, devolver una respuesta con el mensaje de error
            return response()
                ->json(['error' => 'Error al cargar el archivo: ' . $e->getMessage()], 500);
        }
    }


    public function storeUrl(Request $request)
{
    //return $request;
    // Validar la solicitud antes de procesarla
    $request->validate([
        'carpeta' => 'required|integer',
        'nombre' => 'required|max:150',
        'url' => 'required',
    ]);

    // Iniciar transacción de base de datos
    DB::beginTransaction();

    try {
        $uuid = Str::uuid()->toString();

        // Crear una entrada en la base de datos para el archivo cargado
        $archivo = Archivo::create([
            'uuid' => $uuid,
            'url' => $request->url,
            'carpeta_id' => $request->carpeta,
            'user_id' => auth()->id(),
            'nombre_original' => $request->nombre,
            'tipo' => 'enlace', // Asegúrate de que 'tipo' sea 'enlace'
        ]);

        // Commit de la transacción si no hay errores
        DB::commit();
        Cache::flush();

        // Redirigir a la página anterior con un mensaje de éxito
        return redirect()->back()->with('success', 'Enlace guardado exitosamente.');
        
    } catch (\Exception $e) {
        // Rollback de la transacción en caso de error
        DB::rollBack();
        Log::error('Error en storeUrl - Archivo: ' . $e->getMessage());

        // En caso de error, devolver una respuesta con el mensaje de error
        return redirect()
            ->back()
            ->withInput()
            ->with('error', 'Error al guardar enlace: ' . $e->getMessage());
    }
}


    public function download($uuid)
    {
        try {
            // Buscar el archivo en la base de datos usando el UUID
            $archivo = Archivo::where('uuid', $uuid)->first();

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

            Log::error('Error en download - Archivo: ' . $e->getMessage());

            return response()->json(['error' => 'Error al descargar el archivo: ' . $e->getMessage()], 500);
        }
    }
}
