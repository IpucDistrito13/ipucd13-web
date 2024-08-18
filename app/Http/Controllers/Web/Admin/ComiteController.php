<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ComiteRequest;
use App\Models\Comite;
use App\Models\Log as ModelsLog;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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

        return view('admin.comites.index', compact('comites'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('admin.comites.create');
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

            $mini_banner = '';

            // Verificar si se cargó un nuevo banner
            if ($request->hasFile('banner_little')) {
                $fileBanner = $request->file('banner_little');
                $ubicacionBanner = 'public/comites/banner';
                $mini_banner = $this->storeFile($fileBanner, $ubicacionBanner);
            }

            $data = [
                'nombre' => $request->nombre,
                'slug' => $request->slug,
                'descripcion' => $request->descripcion,
                'imagen_banner' => $url_banner,
                'banner_little' => $mini_banner,
            ];

            // Crear el comité
            $comite = Comite::create($data);

            $dataLog = [
                'descripcion' => 'ADD - COMITE - ' . $comite->id,
                'accion' => 'Add',
                'ip' => '',
                'user_id' => auth()->user()->id,
            ];

             ModelsLog::create($dataLog);

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
            Log::error('Error  store - Comite: ' . $e->getMessage());

            // Redireccionar con un mensaje de error
            return redirect()
                ->back()
                ->with('error', 'Error al crear el Comité: ' . $e->getMessage())
                ->withInput();
        }
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
            DB::beginTransaction();
    
            $url_banner = $comite->imagen_banner;
            $mini_banner = $comite->banner_little;
    
            // Manejo del banner
            if ($request->hasFile('imagen_banner')) {
                $fileBanner = $request->file('imagen_banner');
                $ubicacionBanner = 'public/comites/banner';
                $url_banner = $this->storeFile($fileBanner, $ubicacionBanner);
    
                if ($comite->imagen_banner) {
                    Storage::delete($comite->imagen_banner);
                }
            }
    
            // Manejo del mini banner
            if ($request->hasFile('banner_little')) {
                $fileMiniBanner = $request->file('banner_little');
                $ubicacionBanner = 'public/comites/banner';
                $mini_banner = $this->storeFile($fileMiniBanner, $ubicacionBanner);
    
                if ($comite->banner_little) {
                    Storage::delete($comite->banner_little);
                }
            }
    
            // Actualizar el comité
            $comite->update([
                'nombre' => $request->nombre,
                'slug' => $request->slug,
                'descripcion' => $request->descripcion,
                'imagen_banner' => $url_banner,
                'banner_little' => $mini_banner,
            ]);

            /*
            // Registro en log
            ModelsLog::create([
                'descripcion' => 'UPDATE - COMITE - ' . $comite->id,
                'accion' => 'Update',
                'ip' => $request->ip(),
                'user_id' => auth()->user()->id,
            ]);
            */
    
            // Manejo del archivo
            if ($request->hasFile('file')) {
                $filePortada = $request->file('file');
                $ubicacionPortada = 'public/comites/portadas';
                $url = $this->storeFile($filePortada, $ubicacionPortada);
    
                if ($comite->imagen) {
                    Storage::delete($comite->imagen->url);
                    $comite->imagen()->update([
                        'url' => $url,
                        'imageable_type' => Comite::class,
                    ]);
                } else {
                    $comite->imagen()->create([
                        'url' => $url,
                        'imageable_type' => Comite::class,
                    ]);
                }
            }
    
            DB::commit();
            Cache::flush();
    
            return back()->with('success', 'Comité actualizado exitosamente.');
    
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error update - Comite: ' . $e->getMessage());
    
            return back()->with('error', 'Error al actualizar el comité: ' . $e->getMessage())->withInput();
        }
    }
    

    public function destroy(Comite $comite)
    {
        DB::beginTransaction();

        try {
            // Eliminar el banner del comité, si existe
            if ($comite->imagen_banner) {
                $this->deleteFile($comite->imagen_banner);
            }

            // Eliminar todas las imágenes de portada asociadas al comité, si las hay
            if ($comite->imagen()->exists()) {
                foreach ($comite->imagen()->get() as $imagen) {
                    $this->deleteFile($imagen->url);
                    $imagen->delete(); // Eliminar la entrada de la base de datos
                }
            }

            $comite->delete();
            DB::commit();
            Cache::flush();

            // Redireccionar con un mensaje de éxito
            return redirect()
                ->route('admin.comites.index')
                ->with('success', 'Comité eliminado exitosamente.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error  destroy - Comite: ' . $e->getMessage());

            // Redireccionar con un mensaje de error
            return redirect()
                ->back()
                ->with('error', 'No se pudo eliminar el Comité.');
        }
    }

    private function deleteFile($url)
    {
        // Lógica para eliminar el archivo físico dependiendo del entorno
        if (env('APP_ENV') === 'local') {
            Storage::delete($url); // Eliminar archivo localmente
        } else {
            // Lógica para eliminar el archivo en S3 u otro servicio de almacenamiento en la nube
            Storage::disk('s3')->delete($url);
        }
    }
}
