<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ComiteRequest;
use App\Models\Comite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;


class ComiteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //CACHE
        if (Cache::has('comites')) {
            $comites = Cache::get('comites');
        } else {
            $comites = Comite::ListarComites()->latest()->get();
            Cache::put('comites', $comites);
        }
        //CACHE

        return view('admin.comites.index', compact('comites'));
    }

    private function storeFile($file, $ubicacion)
    {
        if (env('APP_ENV') === 'local') {
            return Storage::put($ubicacion, $file);
        } else {
            return Storage::disk('s3')->put($ubicacion, $file);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('admin.comites.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ComiteRequest $request)
    {
        try {
            // Iniciar una transacción de base de datos
            DB::beginTransaction();

            $url_banner = '';

            // Verificar si se cargó un nuevo banner
            if ($request->hasFile('imagen_banner')) {
                $fileBanner = $request->file('imagen_banner');
                $ubicacionBanner = 'public/comites/banner';
                $url_banner = $this->storeFile($fileBanner, $ubicacionBanner);
            }

            $data = [
                'nombre' => $request->nombre,
                'slug' => $request->slug,
                'descripcion' => $request->descripcion,
                'imagen_banner' => $url_banner,
            ];

            // Crear el comité
            $comite = Comite::create($data);

            // Verificar si se cargó un nuevo archivo
            if ($request->hasFile('file')) {
                $filePortada = $request->file('file');
                $ubicacionPortada = 'public/comites/portadas';
                $url = $this->storeFile($filePortada, $ubicacionPortada);

                $comite->imagen()->create([
                    'url' => $url,
                    'imageable_type' => Comite::class,
                ]);
            }

            DB::commit();

            Cache::flush();

            // Redireccionar con un mensaje de éxito
            return redirect()->route('admin.comites.index')
                ->with('success', 'Comité creado exitosamente.');
        } catch (\Exception $e) {
            // Revertir la transacción en caso de error
            DB::rollBack();

            // Redireccionar con un mensaje de error
            return redirect()->back()->with('error', 'Error al crear el comité: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Comite $Comite)
    {
        //return view('admin.comites.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comite $comite)
    {
        return view('admin.comites.edit', [
            'comite' => $comite,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ComiteRequest $request, Comite $comite)
    {
        try {
            // Iniciar una transacción de base de datos
            DB::beginTransaction();
    
            $url_banner = $comite->imagen_banner;
    
            // Verificar si se cargó un nuevo banner
            if ($request->hasFile('imagen_banner')) {
                $fileBanner = $request->file('imagen_banner');
                $ubicacionBanner = 'public/comites/banner';
                $url_banner = $this->storeFile($fileBanner, $ubicacionBanner);
    
                // Eliminar el banner anterior si existe
                if ($comite->imagen_banner) {
                    Storage::delete($comite->imagen_banner);
                }
            }
    
            $data = [
                'nombre' => $request->nombre,
                'slug' => $request->slug,
                'descripcion' => $request->descripcion,
                'imagen_banner' => $url_banner,
            ];
    
            $comite->update($data);
    
            // Verificar si se cargó un nuevo archivo
            if ($request->hasFile('file')) {
                $filePortada = $request->file('file');
                $ubicacionPortada = 'public/comites/portadas';
                $url = $this->storeFile($filePortada, $ubicacionPortada);
    
                if ($comite->imagen) {
                    Storage::delete($comite->imagen->url);
    
                    // Actualizar la relación de imagen con la nueva URL del archivo
                    $comite->imagen()->update([
                        'url' => $url,
                        'imageable_type' => Comite::class,
                    ]);
                } else {
                    // Si el comité no tiene una imagen, agregar una nueva imagen
                    $comite->imagen()->create([
                        'url' => $url,
                        'imageable_type' => Comite::class,
                    ]);
                }
            }
    
            // Commit si no hay errores
            DB::commit();
    
            // Eliminar datos almacenados en cache
            Cache::flush();
    
            // Redireccionar con un mensaje de éxito
            return back()->with('success', 'Comité actualizado exitosamente.');
        } catch (\Exception $e) {
            // Revertir la transacción en caso de error
            DB::rollBack();
    
            // Redireccionar con un mensaje de error
            return back()->with('error', 'Error al actualizar el comité: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *       <img src="{{ !empty($serie->imagen->url) ? Storage::url($serie->imagen->url) : 'https://i.ibb.co/YcvYfpx/640x480.png' }}" alt="" />

     */
    public function destroy(Comite $Comite)
    {
        try {
            $Comite->delete();

            //Elimina la variables almacenada en cache
            Cache::flush();
            //Cache

            $data = [
                'message' => 'Comité eliminado exitosamente.',
            ];

            return redirect()->route('admin.comites.index')->with('success', $data['message']);
        } catch (\Exception $e) {
            $data = [
                'message' => 'No se pudo eliminar el comité, debido a restricción de integridad.',
            ];

            return redirect()->route('admin.comites.index')->with('error', $data['message']);
        }
    }
}
