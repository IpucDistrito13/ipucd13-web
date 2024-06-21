<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Models\Carpetaaux;
use App\Models\Comite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class CarpetaauxController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $carpetasaux = Carpetaaux::ListarCarpetas()->get();
        return view('admin.carpetasaux.index', compact('carpetasaux'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $comites = Comite::SeccionComites()->get();
        return view('admin.carpetasaux.create', [
            'comites' => $comites,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $existingCarpeta = Carpetaaux::where('uuid', $request->uuid)->first();

        if ($existingCarpeta) {
            return redirect()->route('admin.carpetas.create')->with('error', 'Ya existe una carpeta en el sistema.');
        }

        $data = [
            'uuid' => time(),
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'visibilidad' => $request->visibilidad,
            'user_id' => auth()->user()->id,
            'estado' => 'Activo',
        ];

        try {
            Carpetaaux::create($data);
            Cache::flush();
            return redirect()->route('admin.carpetas.create')->with('success', 'Carpeta creada exitosamente.');
        } catch (\Exception $e) {
            return redirect()->route('admin.carpetas.create')->with('error', 'Error al crear la carpeta: ' . $e->getMessage());
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
    public function edit(Carpetaaux $carpetaaux)
    {
        return view('admin.carpetasaux.edit', [
            'carpetaaux' => $carpetaaux,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Carpetaaux $carpetaaux)
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
}
