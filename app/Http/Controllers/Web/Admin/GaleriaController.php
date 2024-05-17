<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Models\Galeria;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class GaleriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        return view('admin.galerias.index');
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Galeria $galeria)
    {
        try {

            $url = $galeria->url;
            Storage::delete($url);
            $galeria->delete();

            $data = [
                'message' => 'Galería eliminada exitosamente.',
            ];
            return back()->with('success', $data['message']);

            //return redirect()->route('admin.galerias.privadoadmin', $galeria->user->uuid)->with('success', $data['message']);
        } catch (\Exception $e) {
        }
    }

    public function upload(Request $request)
    {
        // Validar la solicitud
    
        $usuario = $request->input('usuario');
        $tipo = $request->input('type');
    
        // Verificar si el archivo existe en la solicitud
        if ($request->hasFile('file')) {
            $file = $request->file('file');
    
            // Generar un nombre de archivo único
            $fileName = time() . '-' . $file->getClientOriginalName();
    
            // Validar el tipo de galería y definir la ruta de almacenamiento
            $url = $file->storeAs('public/galeria/' . $usuario, $fileName);
    
            if (!$url) {
                return response()->json(['error' => 'Error al almacenar el archivo.'], 500);
            }
    
            // Generar UUID
            $uuid = (string) Str::uuid();
    
            // Crear el array de datos para guardar en la base de datos
            $data = [
                'uuid' => $uuid,
                'url' => $url,
                'user_id' => $usuario,
                'galeriatipo_id' => $tipo,
                'createdby_id' => Auth::id(),
            ];
    
            // Crear el registro en la base de datos
            try {
                $galeria = Galeria::create($data);
                return response()->json(['message' => 'Se cargaron las fotos exitosamente.', 'uuid' => $uuid], 200);
            } catch (\Exception $e) {
                return response()->json(['error' => 'Error al guardar en la base de datos: ' . $e->getMessage()], 500);
            }
        } else {
            return response()->json(['error' => 'No se ha cargado ningún archivo.'], 400);
        }
    }


    public function privadoAdmin(User $usuario)
    {
        $galerias = Galeria::select('id', 'url', 'galeriatipo_id', 'created_at')
            ->where('galeriatipo_id', 2)
            ->where('user_id', $usuario->id)
            ->latest() // Ordenar las fotos por fecha de creación en orden descendente
            ->paginate(8);
    
        // Formatear created_at a un formato de 12 horas
        foreach ($galerias as $galeria) {
            $galeria->formatted_created_at = $galeria->created_at->format('Y-m-d h:i:s A');
        }
    
        return view('admin.galerias.privado', compact('usuario', 'galerias'));
    }
    


    public function delete(Request $request)
    {
        try {
            $uuid = $request->input('uuid');
    
            // Buscar el archivo con el UUID proporcionado
            $file = Galeria::where('uuid', $uuid)->first();
    
            if ($file) {
                // Eliminar el archivo del almacenamiento
                Storage::delete($file->url);
                // Eliminar el registro de la base de datos
                $file->delete();
    
                return response()->json(['success' => true]);
            } else {
                return response()->json(['success' => false, 'message' => 'Archivo no encontrado.']);
            }
        } catch (\Exception $e) {
            Log::error('Error al eliminar el archivo: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Error al eliminar el archivo.']);
        }
    }
    
}
