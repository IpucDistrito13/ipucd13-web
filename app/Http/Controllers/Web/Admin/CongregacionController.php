<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CongregacionRequest;
use App\Models\Congregacion;
use App\Models\Municipio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;

class CongregacionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //CACHE
        if (Cache::has('congregaciones')) {
            $congregaciones = Cache::get('congregaciones');
        } else {
            $congregaciones = Congregacion::ListarCongregaciones()->get();
            Cache::put('congregaciones', $congregaciones);
        }
        //CACHE
        return view('admin.congregaciones.index', compact('congregaciones'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $municipios = Municipio::selectList();
        return view('admin.congregaciones.create', compact('municipios'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CongregacionRequest $request)
    {
        DB::beginTransaction();
        try {
            Congregacion::create([
                'municipio_id' => $request->municipio,
                'longitud' => $request->longitud,
                'latitud' => $request->latitud,
                'direccion' => $request->direccion,
                'nombre' => $request->nombre,
                'urlfacebook' => $request->urlfacebook,
                'googlemaps' => $request->googlemaps,
                'estado' => 'Activo',
            ]);
    
            // Elimina las variables almacenadas en cache
            Cache::flush();
    
            $data = [
                'message' => 'Congregación creada exitosamente.',
            ];
    
            DB::commit();
            return redirect()->route('admin.congregaciones.index')->with('success', $data['message']);
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Error en store - Congregacion: ' . $e->getMessage());
    
            $data = [
                'message' => 'No se pudo crear la congregación, por favor intente nuevamente.',
            ];
    
            return redirect()->route('admin.congregaciones.index')->with('error', $data['message']);
        }
    }
    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Congregacion $congregacion)
    {
        $municipios = Municipio::selectList();
        return view('admin.congregaciones.edit', [
            'congregacion' => $congregacion,
            'municipios' => $municipios,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CongregacionRequest $request, Congregacion $congregacion)
    {
        DB::beginTransaction();
        try {
            // Actualiza los datos de la congregación
            $congregacion->update([
                'municipio_id' => $request->municipio,
                'longitud' => $request->longitud,
                'latitud' => $request->latitud,
                'direccion' => $request->direccion,
                'nombre' => $request->nombre,
                'urlfacebook' => $request->urlfacebook,
                'googlemaps' => $request->googlemaps,
            ]);
    
            // Elimina las variables almacenadas en cache
            Cache::flush();
    
            $data = [
                'message' => 'Congregación actualizada exitosamente.',
            ];
    
            DB::commit();
            return redirect()->route('admin.congregaciones.edit', $congregacion)->with('success', $data['message']);
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Error en update - Congregacion: ' . $e->getMessage());
    
            $data = [
                'message' => 'No se pudo actualizar la congregación, por favor intente nuevamente.',
            ];
    
            return redirect()->route('admin.congregaciones.edit', $congregacion)->with('error', $data['message']);
        }
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Congregacion $congregacion)
    {
        DB::beginTransaction();
        try {
            $congregacion->delete();

            // Elimina la variable almacenada en cache
            Cache::flush();

            $data = [
                'message' => 'Congregación eliminada exitosamente.',
            ];

            DB::commit();
            return redirect()->route('admin.congregaciones.index')->with('success', $data['message']);
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Error en destroy - Congregacion: ' . $e->getMessage());

            $data = [
                'message' => 'No se pudo eliminar la congregación, debido a restricción de integridad.',
            ];

            return redirect()->route('admin.congregaciones.index')->with('error', $data['message']);
        }
    }
}
