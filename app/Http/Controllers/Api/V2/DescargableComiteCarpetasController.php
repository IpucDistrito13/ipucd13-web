<?php

namespace App\Http\Controllers\Api\V2;

use App\Http\Controllers\Controller;
use App\Http\Resources\V2\Collection\DescargablesComiteCollection;
use App\Models\Archivo;
use App\Models\Carpeta;
use App\Models\Comite;
use Illuminate\Http\Request;

class DescargableComiteCarpetasController extends Controller
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

    //El uuid es del comite
    public function getComitePrivado(Request $request, $slug)
    {
        $comiteId = Comite::where('slug', $slug)->select('id')->first()->id;
        //return 'Holis - Privado';
        return $carpetas = Carpeta::select('id', 'nombre', 'slug', 'created_at')
            ->where('comite_id', $comiteId)
            ->where('galeriatipo_id', 2) // Privado
            ->get();
    }

    //Listar archivos segun la uuid de la carpeta
    public function getArchivosCarpeta(Request $request, $slugCarpeta)
    {
        $carpetaId = Carpeta::where('slug', $slugCarpeta)->select('id')->first()->id;
       // return Archivo::all();
        $archivos = Archivo::where('carpeta_id', $carpetaId)->get();
        return new DescargablesComiteCollection($archivos);
    }

    public function getComitePublico(Request $request, $slug)
    {
        $comiteId = Comite::where('slug', $slug)->select('id')->first()->id;
        //return 'Holis - Privado';
        return $carpetas = Carpeta::select('id', 'nombre', 'slug', 'created_at')
            ->where('comite_id', $comiteId)
            ->where('galeriatipo_id', 1) // Publico
            ->get();
    }
}
