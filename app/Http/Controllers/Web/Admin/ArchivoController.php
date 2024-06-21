<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Models\Archivo;
use App\Models\Carpeta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;


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
        $carpeta = $request->carpeta;

        // Verificar si el archivo existe en la solicitud
        if ($request->hasFile('file')) {
            $file = $request->file('file');

            // Generar un nombre de archivo único
            $fileName = time() . '-' . $file->getClientOriginalName();
            //$fileTimeName = time();

            $url =  $file->storeAs('public/descargables/' . $carpeta, $fileName); // Almacenamiento privado
            $data = [
                'uuid' => time(),
                'url' => $url,
                'carpeta_id' => $carpeta,
                'user_id' => auth()->user()->id,
            ];
            $archivos = Archivo::create($data);

            // Devolver una respuesta de éxito
            return response()->json(['message' => 'Archivo cargado exitosamente'], 200);
        } else {
            // Manejar el caso en el que no se presente ningún archivo en la solicitud
            return response()->json(['error' => 'No se ha cargado ningún archivo'], 400);
        }
    }

    public function download($uuid)
    {
        // Busca el archivo en la base de datos usando el UUID
        $archivo = Archivo::where('uuid', $uuid)->firstOrFail();

        // Obtiene la URL del archivo
        $filePath = storage_path("app/{$archivo->url}");

        // Verifica si el archivo existe
        if (!file_exists($filePath)) {
            abort(404);
        }

        // Devuelve el archivo como respuesta de descarga
        return response()->download($filePath, basename($filePath), [
            'Content-Type' => mime_content_type($filePath)
        ]);
    }
}
