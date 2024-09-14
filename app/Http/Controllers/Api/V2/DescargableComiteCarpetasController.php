<?php

namespace App\Http\Controllers\Api\V2;

use App\Http\Controllers\Controller;
use App\Http\Resources\V2\Collection\ArchivosDetailsCollection;
use App\Http\Resources\V2\Collection\CarpetaDetailsCollection;
use App\Http\Resources\V2\Collection\DescargablesComiteCollection;
use App\Models\Archivo;
use App\Models\Carpeta;
use App\Models\Comite;
use App\Models\GenerarKeyApi;
use Encore\Admin\Grid\Filter\Where;
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
        return new ArchivosDetailsCollection($archivos);
    }

    public function getComitePublico(Request $request, $slug)
    {

        $apiKey = $request->query('api_key');

        // Validar si la clave API es válida
        $apiKeyExists = GenerarKeyApi::ValidarKeyApi($apiKey)->exists();

        // Si la clave API no existe, devolver un mensaje de error con el código de estado 401
        if (!$apiKeyExists) {
            return response()->json([
                'error' => 'No autorizado',
                'message' => 'La clave API proporcionada no es válida.'
            ], 401);
        }

        // Obtener los parámetros limit y offset de la URL
        $limit = $request->query('limit', 10);
        $offset = $request->query('offset', 0);

        $comiteId = Comite::where('slug', $slug)->select('id')->first()->id;
        $carpetas = Carpeta::with('comite')->where('comite_id', $comiteId)
            ->where('galeriatipo_id', 1) // Publico
            ->offset($offset)
            ->limit($limit)
            ->get();

        return new CarpetaDetailsCollection($carpetas);
    }

    public function searchPublicoComite(Request $request)
{
    // Obtener la clave API del parámetro
    $apiKey = $request->query('api_key');
    $apiKeyExists = GenerarKeyApi::ValidarKeyApi($apiKey)->exists();

    // Si la clave API no existe, devolver un mensaje de error con el código de estado 401
    if (!$apiKeyExists) {
        return response()->json([
            'error' => 'No autorizado',
            'message' => 'La clave API proporcionada no es válida.'
        ], 401);
    }

    $query = $request->input('query');
    $comiteSlug = $request->input('comite');

    if (!$query) {
        return response()->json([
            'error' => 'Debe proporcionar un término de búsqueda.'
        ], 400);
    }

    if (!$comiteSlug) {
        return response()->json([
            'error' => 'Debe proporcionar un comité de búsqueda.'
        ], 400);
    }

    // Obtener el ID del comité según el slug
    $comite = Comite::select('id')->where('slug', $comiteSlug)->first();

    // Verificar si el comité existe
    if (!$comite) {
        return response()->json([
            'error' => 'Comité no encontrado.'
        ], 404);
    }

    // Dividir el término de búsqueda en palabras
    $searchTerms = explode(' ', $query);

    // Construir la consulta para buscar según los términos en la carpeta (comité)
    $carpetas = Carpeta::where('comite_id', $comite->id)
        ->where('galeriatipo_id', 1) // Filtro adicional para galeriatipo_id 1 (General o público)
        ->where(function ($query) use ($searchTerms) {
            foreach ($searchTerms as $term) {
                $query->orWhere('nombre', 'LIKE', '%' . $term . '%');
            }
        })
        ->get();

    return new CarpetaDetailsCollection($carpetas);
}


    public function searchPrivadoComite(Request $request)
    {
        public function searchPublicoComite(Request $request)
        {
            // Obtener la clave API del parámetro
            $apiKey = $request->query('api_key');
            $apiKeyExists = GenerarKeyApi::ValidarKeyApi($apiKey)->exists();
        
            // Si la clave API no existe, devolver un mensaje de error con el código de estado 401
            if (!$apiKeyExists) {
                return response()->json([
                    'error' => 'No autorizado',
                    'message' => 'La clave API proporcionada no es válida.'
                ], 401);
            }
        
            $query = $request->input('query');
            $comiteSlug = $request->input('comite');
        
            if (!$query) {
                return response()->json([
                    'error' => 'Debe proporcionar un término de búsqueda.'
                ], 400);
            }
        
            if (!$comiteSlug) {
                return response()->json([
                    'error' => 'Debe proporcionar un comité de búsqueda.'
                ], 400);
            }
        
            // Obtener el ID del comité según el slug
            $comite = Comite::select('id')->where('slug', $comiteSlug)->first();
        
            // Verificar si el comité existe
            if (!$comite) {
                return response()->json([
                    'error' => 'Comité no encontrado.'
                ], 404);
            }
        
            // Dividir el término de búsqueda en palabras
            $searchTerms = explode(' ', $query);
        
            // Construir la consulta para buscar según los términos en la carpeta (comité)
            $carpetas = Carpeta::where('comite_id', $comite->id)
                ->where('galeriatipo_id', 2) // Filtro adicional para galeriatipo_id 2 (Privado)
                ->where(function ($query) use ($searchTerms) {
                    foreach ($searchTerms as $term) {
                        $query->orWhere('nombre', 'LIKE', '%' . $term . '%');
                    }
                })
                ->get();
        
            return new CarpetaDetailsCollection($carpetas);
        }
        
}
