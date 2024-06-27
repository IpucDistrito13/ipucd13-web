<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Models\Archivo;
use App\Models\Carpeta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;



class ArchivoController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index(Carpeta $carpeta)
    {
        $archivos = Archivo::all();
        return view('admin.archivos.index', compact('carpeta', 'archivos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    private function storeFile($file, $ubicacion)
    {
        if (env('APP_ENV') === 'local') {
            return Storage::put($ubicacion, $file);
        } else {
            return Storage::disk('s3')->put($ubicacion, $file);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Archivo $archivo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Archivo $archivo)
    {
        try {
            $archivo->delete();

            Cache::flush();

            $data = [
                'message' => 'Archivo eliminado exitosamente.',
            ];

            return back()->with('success', $data['message']);
        } catch (\Exception $e) {
            $data = [
                'message' => 'No se pudo eliminar el comité, debido a restricción de integridad.',
            ];

            return back()->with('error', $data['message']);
        }
    }

    public function upload(Request $request)
    {
        try {
            // Iniciar transacción de base de datos
            DB::beginTransaction();

            // Obtener la carpeta desde la solicitud
            $carpeta = $request->carpeta;

            // Verificar si el archivo existe en la solicitud
            if ($request->hasFile('file')) {
                $file = $request->file('file');

                // Almacenar el archivo utilizando la función storeFile según el entorno
                $url = $this->storeFile($file, 'public/descargables/' . $carpeta);

                // Crear una entrada en la base de datos para el archivo cargado
                $data = [
                    'uuid' => time(), // Puedes usar esto o generar un UUID único según tu lógica
                    'url' => $url,
                    'carpeta_id' => $carpeta,
                    'user_id' => auth()->user()->id,
                ];

                $archivo = Archivo::create($data);

                // Commit de la transacción si no hay errores
                DB::commit();

                // Devolver una respuesta de éxito
                return response()->json(['message' => 'Archivo cargado exitosamente', 'archivo' => $archivo], 200);
            } else {
                // Rollback de la transacción si no se proporciona ningún archivo
                DB::rollBack();

                // Manejar el caso en el que no se presente ningún archivo en la solicitud
                return response()->json(['error' => 'No se ha cargado ningún archivo'], 400);
            }
        } catch (\Exception $e) {
            // Rollback de la transacción en caso de error
            DB::rollBack();

            // En caso de error, devolver una respuesta con el mensaje de error
            return response()->json(['error' => 'Error al cargar el archivo: ' . $e->getMessage()], 500);
        }
    }


    public function download($uuid)
    {
        try {
            // Busca el archivo en la base de datos usando el UUID
            $archivo = Archivo::where('uuid', $uuid)->firstOrFail();

            // Obtiene la URL del archivo almacenado
            $filePath = storage_path("app/{$archivo->url}");

            // Verifica si el archivo existe
            if (!file_exists($filePath)) {
                return redirect()->back()->with('error', 'El archivo solicitado no existe.');
            }

            // Devuelve el archivo como respuesta de descarga
            return response()->download($filePath, basename($filePath), [
                'Content-Type' => mime_content_type($filePath),
            ]);
        } catch (\Exception $e) {
            // En caso de error al buscar el archivo
            return redirect()->back()->with('error', 'El archivo solicitado no fue encontrado.');
        }
    }
}
