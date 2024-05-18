<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Models\Carpeta;
use App\Models\Comite;
use Illuminate\Http\Request;

class CarpetaController extends Controller
{
    // LISTA LOS COMITES CON LAS CARPETAS PRIVADAS
    public function listComitePrivado()
    {
        $comites = Comite::select('id', 'nombre', 'slug')->get();
        return view('admin.carpetas.descargable_privado', compact('comites'));
    }

    public function listCarpetasPrivadoComite(Comite $comite)
    {
         $carpetas = Carpeta::where('comite_id', $comite->id)->get();
        return view('admin.carpetas.carpetas_privado', compact('comite', 'carpetas'));
    }

    // CREAR CARPETA PRIVADO
    public function carpetaPrivado(Comite $comite)
    {
        return view('admin.carpetas.carpetaprivado_create', compact('comite'));
    }

    public function crearCarpetaPrivada(Comite $comite)
    {
        return view('admin.carpetas.carpetaprivada_create', compact('comite'));
    }

    public function storeCarpetaPrivada(Request $request)
    {
      //  return $request;
        $data = [
            'nombre' => $request->nombre,
            'slug' => $request->slug,
            'descripcion' => $request->descripcion,
            'comite_id' => $request->comite,
            'galeriatipo_id' => 2, //Galeria type  2 = privado
        ];


        //return $data;

        $carpeta = Carpeta::create($data);

        $data = [
            'message' => 'Carpeta creada exitosamente.',
        ];

      //  return $carpeta;

        return redirect()->route('admin.carpetas.listComitePrivado')->with('success', $data['message']);

    }

    /*
    public function carpetaPrivado(Comite $comite)
    { 
        //return $comite;
         $carpetas = Carpeta::where('comite_id', $comite->id)->get();
        //return $carpetas = Carpeta::where('comite_id', $comite)->get();
        return view('admin.carpetas.carpeta_privada', compact('comite', 'carpetas'));
    }
    */

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

    public function privadoArchivos(Carpeta $carpeta)
    {
        return $carpeta;
        // return $carpeta; privadoArchivos
    }
}
