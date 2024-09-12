<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Models\Redes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class RedesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function updateTransmision(Request $request, Redes $redes)
    {
        // Validar los datos del request
        $validatedData = $request->validate([
            'id' => 'required|exists:redes,id',
            'url' => 'nullable|max:255',
        ]);
    
        // Obtener el registro a actualizar
        $redes = Redes::findOrFail($validatedData['id']);
    
        // Extraer el ID del video de YouTube si se proporciona la URL
        if (!empty($validatedData['url'])) {
            $videoId = $this->extractYouTubeId($validatedData['url']);
            $validatedData['url'] = $videoId;
        } else {
            // Si la URL está vacía, se establece como null
            $validatedData['url'] = null;
        }
    
        // Actualizar el registro con los datos validados
        $redes->update([
            'url' => $validatedData['url'],
        ]);
    
        // Limpiar la caché
        Cache::flush();
    
        // Redirigir al dashboard con un mensaje de éxito
        return redirect()->route('admin.dashboard')->with('success', 'Transmisión actualizada exitosamente.');
    }
    
    // Función para extraer el ID del video de YouTube (incluyendo live)
    private function extractYouTubeId($url)
    {
        preg_match('/(?:https?:\/\/)?(?:www\.)?(?:youtube\.com\/(?:watch\?v=|live\/)|youtu\.be\/)([a-zA-Z0-9_-]+)/', $url, $matches);
        return $matches[1] ?? null;
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
