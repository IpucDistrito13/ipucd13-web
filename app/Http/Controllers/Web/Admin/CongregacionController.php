<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CongregacionRequest;
use App\Models\Comite;
use App\Models\Congregacion;
use App\Models\Municipio;
use Illuminate\Http\Request;
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

        /*
        $congregaciones = Congregacion::select('id', 'municipio_id', 'direccion')
            ->with('municipio:id,nombre,departamento_id')->get();
            */
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
        Congregacion::create([
            'municipio_id' => $request->municipio,
            'longitud' => $request->longitud,
            'latitud' => $request->latitud,
            'direccion' => $request->direccion,
            'nombre' => $request->nombre,
        ]);

        Cache::flush();

        return redirect()->route('admin.congregaciones.create')
            ->with('success', 'Congregación creada exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Congregacion $congregacion)
    {
        //return view('admin.congregaciones.show', compact('congregacion'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Congregacion $congregacion)
    {
        $municipios = Municipio::selectList();
        return view('admin.congregaciones.edit', compact('congregacion', 'municipios'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CongregacionRequest $request, Congregacion $congregacion)
    {
        $congregacion->update([
            'municipio_id' => $request->municipio,
            'longitud' => $request->longitud,
            'latitud' => $request->latitud,
            'direccion' => $request->direccion,
            'nombre' => $request->nombre
        ]);

        Cache::flush();

        return redirect()->route('admin.congregaciones.edit', $congregacion)
            ->with('success', 'Congregación actualizada exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Congregacion $congregacion)
    {
        try {
            $congregacion->delete();

            Cache::flush();

            return redirect()->route('admin.congregaciones.index')
                ->with('success', 'Congregación eliminada exitosamente.');
                
        } catch (\Exception $e) {
            $data = [
                'message' => 'No se pudo eliminar la congregación, debido a restricción de integridad.',
            ];

            return redirect()->route('admin.congregaciones.index')->with('error', $data['message']);
        }
    }

    public function registroCongregacion()
    {
        $comitesMenu = Comite::ComiteMenu()->get();
        $municipios = Municipio::selectList();
        $congregaciones = Congregacion::select('id', 'direccion', 'nombre')->where('estado', 'Activo')->get();

        return view('public.registros.congregacion_pastor', [
            'comites' => $comitesMenu,
            'municipios' => $municipios,

        ]);

    }

    
}
