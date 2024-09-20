<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SolicitudDescargableRequest;
use App\Models\SolicitudDescargable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
class SolicitudDescargableController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     * 
     */ 
    public function __construct()
    {
        $this->middleware('can:admin.solicitud_tipos.index')->only('index', 'download');
    }
     public function index()
    {
        //return 'Hola';
        /*
        //CACHE
        if (Cache::has('solicitud_descargable')) {
            $solicitud_descargable = Cache::get('solicitud_descargable');
        } else {
            $solicitud_descargable = SolicitudDescargable::listarCampos()->get();
            Cache::put('solicitud_descargable', $solicitud_descargable);
        }
        //CACHE
        */

        

        //return SolicitudDescargable::all();
        $solicitud_descargable = SolicitudDescargable::all();
        return view('admin.solicitudtipos.descargables.index', compact('solicitud_descargable'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.solicitudtipos.descargables.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SolicitudDescargableRequest $request)
    {
        $url_archivo = '';
        $uuid = Str::uuid()->toString();

        // Verificar si se cargó un nuevo banner
        if ($request->hasFile('url')) {
            $fileArchivo = $request->file('url');
            $originalName = $fileArchivo->getClientOriginalName();
            $ubicacionArchivo = 'public/solicitud/descargables/';
            $url_archivo = $this->storeFile($fileArchivo, $ubicacionArchivo);
            // Almacenar el archivo utilizando storeFile

        }

        // Crear el registro en la base de datos
        try {
            SolicitudDescargable::create([
                'nombre' => $request->nombre,
                'slug' => $request->slug,
                'descripcion' => $request->descripcion,
                'url' => $url_archivo,
                'uuid' => $uuid,
                'nombre_original' => $originalName,
                'tipo' => 'Archivo',
                'estado' => $request->estado,
            ]);

            // Elimina datos cache
            Cache::flush();

            return redirect()->route('admin.solicitud_descargable.index')
                ->with('success', 'Solicitud descargable creado exitosamente.');
        } catch (\Exception $e) {
            // Si ocurre un error, redirigir de vuelta con un mensaje de error
            return redirect()->back()
                ->withInput()
                ->withErrors(['error' => 'Error al guardar: ' . $e->getMessage()]);
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SolicitudDescargable $solicitud_descargable)
    {
        return view('admin.solicitudtipos.descargables.edit', compact('solicitud_descargable'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SolicitudDescargableRequest $request, SolicitudDescargable $solicitud_descargable)
    {

        // return $solicitud_descargable;
        try {


            // Verificar si se cargó un nuevo archivo
            if ($request->file('url')) {

                $fileArchivo = $request->file('url');
                $originalName = $fileArchivo->getClientOriginalName();
                $ubicacionArchivo = 'public/solicitud/descargables/';
                $url_archivo = $this->storeFile($fileArchivo, $ubicacionArchivo);

                if ($solicitud_descargable->url) {
                    Storage::delete($solicitud_descargable->url);
                }



                // Almacenar el archivo y obtener la URL
                // $url_archivo = Storage::put('public/solicitud/descargables/', $request->file('url'));

                // Si la solicitud ya tiene una imagen, eliminarla
                if ($solicitud_descargable->url) {
                    Storage::delete($solicitud_descargable->url);
                }

                // Datos a actualizar en la solicitud
                $data = [
                    'nombre' => $request->nombre,
                    'slug' => $request->slug,
                    'descripcion' => $request->descripcion,
                    'url' => $url_archivo,
                    'nombre_original' => $originalName,
                    'tipo' => 'Archivo',
                    'estado' => $request->estado,
                ];

                // Actualizar la solicitud
                $solicitud_descargable->update($data);

                // Limpiar la caché
                Cache::flush();

                // Redireccionar con un mensaje de éxito
                return redirect()->route('admin.solicitud_descargables.index')
                    ->with('success', 'Solicitud descargable actualizada exitosamente.');
            }

            // En caso de no haber archivo, redireccionar con mensaje de error
            return redirect()->route('admin.solicitud_descargables.index')
                ->with('error', 'No se ha cargado ningún archivo.');
        } catch (\Exception $e) {
            // Capturar excepciones generales
            return redirect()->route('admin.solicitud_descargables.index')
                ->with('error', 'Ocurrió un error al procesar la solicitud: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
 
     public function destroy(SolicitudDescargable $solicitud_descargable)
     {
         DB::beginTransaction();
 
         try {
             // Eliminar el banner del comité, si existe
             if ($solicitud_descargable->url) {
                 $this->deleteFile($solicitud_descargable->url);
             }

             $solicitud_descargable->delete();
             DB::commit();
             Cache::flush();
 
             // Redireccionar con un mensaje de éxito
             return redirect()
                 ->route('admin.solicitud_descargables.index')
                 ->with('success', 'Soiicitud descargable eliminado exitosamente.');
         } catch (\Exception $e) {
             DB::rollBack();
             Log::error('Error  destroy - Solicitud descargable: ' . $e->getMessage());
 
             // Redireccionar con un mensaje de error
             return redirect()
                 ->back()
                 ->with('error', 'No se pudo eliminar la solicitud descargable.');
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
}
