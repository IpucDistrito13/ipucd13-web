<?php

namespace App\Http\Controllers\Api\V2;

use App\Http\Controllers\Controller;
use App\Http\Resources\V2\Collection\GaleriaCollection;
use App\Models\Galeria;
use App\Models\User;
use Illuminate\Http\Request;

class GaleriaController extends Controller
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    /*
    public function  showGaleriaPrivada()
    {
        // Obtener el usuario autenticado
        $usuario = auth()->user();

        // Verificar si el usuario tiene el rol 'Pastor' o 'Administrador'
        if ($usuario && $usuario->roles->contains(function ($role) {
            return in_array($role->name, ['Pastor', 'Administrador']);
        })) {
            // Mostrar toda la galería para los usuarios con el rol 'Pastor' o 'Administrador'
            return $galeria = Galeria::all(); // Supongamos que tienes un modelo Galeria
            //return new GaleriaCollection($galeria);
        }

        // Si no es 'Pastor', mostrar una galería filtrada (por ejemplo)
        // $galeriaFiltrada = Galeria::where('categoria', 'Pública')->get(); // Ejemplo de filtrado
        // return new GaleriaCollection($galeriaFiltrada);
    }
    */

    public function showGaleriaPrivadaUsuario($uuid)
    {
        // Obtener el usuario autenticado
        $usuario = auth()->user();
    
        // Obtener el ID del usuario basado en el UUID
        $user_id = User::where('uuid', $uuid)->first()->id;
    
        // Verificar si el usuario autenticado tiene el rol 'Pastor' o 'Administrador'
        if ($usuario && $usuario->roles->contains(function ($role) {
            return in_array($role->name, ['Pastor', 'Administrador']);
        })) {
            // Mostrar solo los elementos con galeriatipo_id = 2 para el user_id especificado
            $galeria = Galeria::where('user_id', $user_id)
                              ->where('galeriatipo_id', 2)
                              ->get(); 
            return new GaleriaCollection($galeria);
        }
    
        return response()->json(['message' => 'No tiene acceso a esta galería'], 403);
    }

    
    

    public function showGaleriaPublicaUsuario($uuid)
    {
        // Obtener el usuario autenticado
        $usuario = auth()->user();
    
        // Obtener el ID del usuario basado en el UUID
        $user_id = User::where('uuid', $uuid)->first()->id;
    
        // Verificar si el usuario autenticado tiene el rol 'Pastor' o 'Administrador'
        if ($usuario && $usuario->roles->contains(function ($role) {
            return in_array($role->name, ['Pastor', 'Administrador', 'Lider']);
        })) {
            // Mostrar solo los elementos con galeriatipo_id = 2 para el user_id especificado
            $galeria = Galeria::where('user_id', $user_id)
                              ->where('galeriatipo_id', 1)
                              ->get(); 
            return new GaleriaCollection($galeria);
        }
    
        return response()->json(['message' => 'No tiene acceso a esta galería'], 403);
    }
    
}
