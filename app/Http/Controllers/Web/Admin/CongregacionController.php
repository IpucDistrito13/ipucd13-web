<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CongregacionRequest;
use App\Models\Congregacion;
use App\Models\Municipio;
use App\Models\RegistroLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

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

            $congregacion = Congregacion::create([
                'municipio_id' => $request->municipio,
                'longitud' => $request->longitud,
                'latitud' => $request->latitud,
                'direccion' => $request->direccion,
                'nombre' => $request->nombre,
                'urlfacebook' => $request->urlfacebook,
                'googlemaps' => $request->googlemaps,
                'estado' => 'Activo',
            ]);

            // Manejar la imagen de portada si se proporciona
            if ($request->hasFile('file')) {
                $fileFachada = $request->file('file');
                $ubicacionPortada = 'public/congregaciones';
                $url = $this->storeFile($fileFachada, $ubicacionPortada);
                $congregacion->imagen()->create([
                    'url' => $url,
                    'imageable_type' => Congregacion::class,
                ]);
            }

            // Registro en log
            RegistroLog::create([
                'descripcion' => 'ADD - CONGREGACION - ' .  $congregacion->id,
                'accion' => 'Add',
                'ip' => '',
                'user_id' => auth()->user()->id,
            ]);


            // Elimina las variables almacenadas en cache
            DB::commit();
            Cache::flush();

            return redirect()->route('admin.congregaciones.index')
                ->with('success', 'Congregación creada exitosamente.');
        } catch (\Throwable $th) {
            DB::rollback();
            Log::error('Error en store - Congregacion: ' . $th->getMessage());

            return redirect()->route('admin.congregaciones.index')
                ->with('error', 'No se pudo crear la congregación, por favor intente nuevamente.' .$th);
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

            // Manejar la imagen de portada si se proporciona
            if ($request->hasFile('file')) {
                $fileFachada = $request->file('file');
                $ubicacionPortada = 'public/congregaciones';
                $url = $this->storeFile($fileFachada, $ubicacionPortada);

                if ($congregacion->imagen) {
                    Storage::delete($congregacion->imagen->url);
    
                    // Actualizar la relación de imagen con la nueva URL del archivo
                    $congregacion->imagen()->update([
                        'url' => $url,
                        'imageable_type' => Congregacion::class,
                    ]);
                } else {
                    // Si la categoría no tiene una imagen, agregar una nueva imagen
                    $congregacion->imagen()->create([
                        'url' => $url,
                        'imageable_type' => Congregacion::class,
                    ]);
                }

            }

            // Registro en log
            RegistroLog::create([
                'descripcion' => 'UPDATE - CONGREGACION - ' . $congregacion->id,
                'accion' => 'Update',
                'ip' => $request->ip(),
                'user_id' => auth()->user()->id,
            ]);

            


            // Elimina las variables almacenadas en cache
            Cache::flush();
            DB::commit();

            $data = [
                'message' => 'Congregación actualizada exitosamente.',
            ];

            return redirect()->route('admin.congregaciones.edit', $congregacion)->with('success', $data['message']);
        } catch (\Throwable $th) {
            DB::rollBack(); // Rollback en caso de error
            Log::error('Error en update - Congregacion: ' . $th->getMessage());

            $data = [
                'message' => 'No se pudo actualizar la congregación, por favor intente nuevamente.',
            ];

            return redirect()
                ->route('admin.congregaciones.edit', $congregacion)
                ->with('error', $data['message']);
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

    private function storeFile($file, $location)
    {
        if (env('APP_ENV') === 'local') {
            return Storage::put($location, $file);
        } else {
            return Storage::disk('s3')->put($location, $file);
        }
    }
}
