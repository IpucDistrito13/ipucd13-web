<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Models\GenerarKeyApi;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB; // Asegúrate de incluir esta importación si no está ya


class GenerarApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $apis = GenerarKeyApi::all();
        return view('admin.apis.index', [
            'apis' => $apis,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // $apiKey =  Str::random(32); // Genera una cadena aleatoria de 32 caracteres
        return view('admin.apis.create', [
            //'apiKey' => $apiKey
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Iniciar una transacción
        DB::beginTransaction();
    
        try {
            // Generar la clave API
            $apiKey = Str::random(32);
    
            // Preparar los datos para la inserción
            $data = [
                'apikey' => $apiKey,
                'descripcion' => $request->descripcion,
                'tipo' => $request->tipo
            ];
    
            // Crear el registro en la base de datos
            GenerarKeyApi::create($data);
    
            // Confirmar la transacción
            DB::commit();
    
            // Redirigir con un mensaje de éxito
            return redirect()->route('admin.keyapis.index')
                             ->with('success', 'Permiso creado y asignado exitosamente.');
    
        } catch (\Exception $e) {
            // Deshacer la transacción en caso de error
            DB::rollBack();
    
            // Registrar el error y redirigir con un mensaje de error
            Log::error('Error en store - GenerarKeyApi: ' . $e->getMessage());
    
            return redirect()->back()->with('error', 'Ocurrió un error al crear la clave API.');
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
}
