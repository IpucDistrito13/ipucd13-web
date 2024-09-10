<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SolicitudTipoRequest;
use App\Models\SolicitudTipo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class SolicitudTipoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //CACHE
        if (Cache::has('solicitud_tipo')) {
            $solicitud_tipo = Cache::get('solicitud_tipo');
        } else {
            $solicitud_tipo = SolicitudTipo::listarCampos()->get();
            Cache::put('solicitud_tipo', $solicitud_tipo);
        }
        //CACHE

        //$solicitud_tipo = SolicitudTipo::listarCampos()->get();
        return view('admin.solicitudtipos.index', compact('solicitud_tipo'));
    }

    /**
     * Show the form for creating a new resource.
     */

    public function create()
    {
        return view('admin.solicitudtipos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SolicitudTipoRequest $request)
    {
   
        SolicitudTipo::create([
            'nombre' => $request->nombre,
            'slug' => $request->slug,
            'descripcion' => $request->descripcion,
            'estado' => $request->estado,
        ]);

        $data = [
            'message' => 'Tipo de solicitud creado exitosamente.',
        ];

        //Elimina datos cache
        Cache::flush();
        //Cache

        return redirect()->route('admin.solicitud_tipos.index')->with('success', $data['message']);
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
    public function edit(SolicitudTipo $solicitud_tipo)
    {
        return view('admin.solicitudtipos.edit', compact('solicitud_tipo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SolicitudTipoRequest $request, SolicitudTipo $solicitud_tipo)
    {
        $solicitud_tipo->update($request->all());

        $data = [
            'message' => 'Tipo de solicitud actualizado exitosamente.',
        ];

        //Elimina datos cache
        Cache::flush();
        //Cache

        return redirect()->route('admin.solicitud_tipos.edit', $solicitud_tipo)->with('success', $data['message']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SolicitudTipo $solicitud_tipo)
    {
        try {
            $solicitud_tipo->delete();

            $data = [
                'message' => 'Tipo de solicitud eliminado exitosamente.',
            ];
            
            //Elimina datos cache
            Cache::flush();
            //Cache

            return redirect()->route('admin.solicitud_tipos.index')->with('success', $data['message']);
        } catch (\Exception $e) {
            $data = [
                'message' => 'No se pudo eliminar el tipo de solicitud, debido a restricción de integridad.',
            ];

            //Elimina datos cache
            Cache::flush();
            //Cache

            return redirect()->route('admin.solicitud_tipos.index')->with('error', $data['message']);
        }
    }
}
