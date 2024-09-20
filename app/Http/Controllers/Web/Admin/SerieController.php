<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SerieRequest;
use App\Models\Categoria;
use App\Models\Comite;
use App\Models\Serie;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SerieController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:admin.series.index')->only(  'index');
        $this->middleware('can:admin.series.create')->only(  'create', 'edit',  'destroy', 'listVideos');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //CACHE
        if (Cache::has('series')) {
            $series = Cache::get('series');
        } else {
            $series = Serie::with('comite:id,nombre', 'categoria:id,nombre')
                ->withCount('videos')  // Añadir conteo de videos
                ->get();
            Cache::put('series', $series);
        }
        //CACHE

        // Verificar si $series está vacío
        if ($series->isEmpty()) {
            $series = collect(); // Crear una colección vacía
        }

        return view('admin.series.index', compact('series'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $comites = Comite::selectList()->get();
        $categorias = Categoria::selectList()->get();
        return view('admin.series.create', [
            'comites' => $comites,
            'categorias' => $categorias,
        ]);
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
    public function store(SerieRequest $request)
    {


        try {
            // Iniciar una transacción de base de datos
            DB::beginTransaction();

            $url_banner = '';

            // Verificar si se cargó un nuevo banner
            if ($request->hasFile('imagen_banner')) {
                $fileBanner = $request->file('imagen_banner');
                $ubicacionBanner = 'public/series/banner';
                $url_banner = $this->storeFile($fileBanner, $ubicacionBanner);
            }

            $data = [

                'comite_id' => $request->comite,
                'categoria_id' => $request->categoria,
                'titulo' => $request->titulo,
                'slug' => $request->slug,
                'descripcion' => $request->descripcion,
                'contenido' => $request->contenido,
                'imagen_banner' => $url_banner,
                'estado' => 'Publicado',
                'user_id' => auth()->user()->id,
            ];

            $serie = Serie::create($data);

            // Verificar si se cargó un nuevo archivo
            if ($request->hasFile('file')) {
                $filePortada = $request->file('file');
                $ubicacionPortada = 'public/series/portadas';
                $url = $this->storeFile($filePortada, $ubicacionPortada);

                $serie->imagen()->create([
                    'url' => $url,
                    'imageable_type' => Serie::class,
                ]);
            }

            DB::commit();
            Cache::flush();

            return redirect()->route('admin.series.index')
                ->with('success', 'Serie creada exitosamente.');
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Error store - Serie: ' . $e->getMessage());

            return redirect()->back()
                ->withInput()
                ->with('error', 'Error al crear la serie. Por favor, inténtelo de nuevo.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Serie $serie)
    {
        $comites = Comite::selectList()->get();
        $categorias = Categoria::selectList()->get();
        return view('admin.series.edit', compact('serie', 'comites', 'categorias'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SerieRequest $request, Serie $serie)
    {
        try {
            // Iniciar una transacción de base de datos
            DB::beginTransaction();

            $url_banner = $serie->imagen_banner;

            // Verificar si se cargó un nuevo banner
            if ($request->hasFile('imagen_banner')) {
                $fileBanner = $request->file('imagen_banner');
                $ubicacionBanner = 'public/series/banner';
                $url_banner = $this->storeFile($fileBanner, $ubicacionBanner);

                // Eliminar el banner anterior si existe
                if ($serie->imagen_banner) {
                    Storage::delete($serie->imagen_banner);
                }
            }

            $data = [
                'titulo' => $request->titulo,
                'slug' => $request->slug,
                'descripcion' => $request->descripcion,
                'contenido' => $request->contenido,
                'imagen_banner' => $url_banner,
                'comite_id' => $request->comite,
                'categoria_id' => $request->categoria,
            ];

            $serie->update($data);

            // Verificar si se cargó un nuevo archivo
            if ($request->hasFile('file')) {
                $filePortada = $request->file('file');
                $ubicacionPortada = 'public/series/portadas';
                $url = $this->storeFile($filePortada, $ubicacionPortada);

                if ($serie->imagen) {
                    Storage::delete($serie->imagen->url);

                    // Actualizar la relación de imagen con la nueva URL del archivo
                    $serie->imagen()->update([
                        'url' => $url,
                        'imageable_type' => Serie::class,
                    ]);
                } else {
                    // Si la serie no tiene una imagen, agregar una nueva imagen
                    $serie->imagen()->create([
                        'url' => $url,
                        'imageable_type' => Serie::class,
                    ]);
                }
            }

            // Commit si no hay errores
            DB::commit();

            // Eliminar datos almacenados en cache
            Cache::flush();

            // Redireccionar con un mensaje de éxito
            return redirect()
                ->route('admin.series.edit', $serie)
                ->with('success', 'Serie actualizada exitosamente.');
        } catch (\Exception $e) {
            // Revertir la transacción en caso de error
            DB::rollBack();
            Log::error('Error  update - Serie: ' . $e->getMessage());

            // Redireccionar con un mensaje de error
            return redirect()
                ->back()
                ->with('error', 'Error al actualizar la serie: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Serie $serie)
    {
        DB::beginTransaction();

        try {
            // Eliminar el banner de la serie, si existe
            if ($serie->imagen_banner) {
                $this->deleteFile($serie->imagen_banner);
            }

            // Eliminar todas las imágenes de portada asociadas a la serie, si las hay
            if ($serie->imagen()->exists()) {
                foreach ($serie->imagen()->get() as $imagen) {
                    $this->deleteFile($imagen->url);
                    $imagen->delete(); // Eliminar la entrada de la base de datos
                }
            }

            // Eliminar la serie
            $serie->delete();
            DB::commit();
            Cache::flush();

            // Redireccionar con un mensaje de éxito
            return redirect()
                ->route('admin.series.index')
                ->with('success', 'Serie eliminada exitosamente.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error  destroy - Serie: ' . $e->getMessage());


            // Redireccionar con un mensaje de error
            return redirect()
                ->back()
                ->with('error', 'No se pudo eliminar la serie, debido a restricción de integridad.');
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

    //LISTAR LOS VIDEOS SEGUN LA SERIE
    public function listVideos(Serie $serie)
    {

        //CACHE
        $serie_id = $serie->id;
        $cache_key = 'admin.videos.' . $serie_id;

        if (Cache::has($cache_key)) {
            $videos = Cache::get($cache_key);
        } else {
            $videos = Video::ListarVideoSerie($serie_id)->get();
            Cache::put($cache_key, $videos);
        }
        //CACHE

        return view('admin.series.videos', compact('serie', 'videos'));
    }
}
