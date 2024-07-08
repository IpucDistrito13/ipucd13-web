<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PodcastRequest;
use App\Models\Categoria;
use App\Models\Comite;
use App\Models\Episodio;
use App\Models\Podcast;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PodcastController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //CACHE
        if (Cache::has('podcasts')) {
            $podcasts = Cache::get('podcasts');
        } else {
            $podcasts = Podcast::with('comite:id,nombre', 'categoria:id,nombre')
                ->withCount('episodios')
                ->orderBy('created_at', 'desc') // Ordenar por fecha de creación en orden descendente
                ->get();
            Cache::put('podcasts', $podcasts);
        }
        //CACHE

        return view('admin.podcasts.index', compact('podcasts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $comites = Comite::selectList()->get();
        $categorias = Categoria::selectList()->get();
        return view('admin.podcasts.create', compact('comites', 'categorias'));
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
    public function store(PodcastRequest $request)
    {
        DB::beginTransaction();

        try {
            $url_banner = '';

            // Verificar y almacenar el nuevo banner si se proporciona
            if ($request->hasFile('imagen_banner')) {
                $fileBanner = $request->file('imagen_banner');
                $ubicacionBanner = 'public/podcasts/banner';
                $url_banner = $this->storeFile($fileBanner, $ubicacionBanner);
            }

            // Crear el podcast con los datos proporcionados
            $podcast = Podcast::create([
                'titulo' => $request->titulo,
                'slug' => $request->slug,
                'descripcion' => $request->descripcion,
                'contenido' => $request->contenido,
                'imagen_banner' => $url_banner,
                'comite_id' => $request->comite,
                'categoria_id' => $request->categoria,
                'estado' => 'Publicado',
                'user_id' => auth()->user()->id,
            ]);

            // Verificar y almacenar el archivo de portada si se proporciona
            if ($request->hasFile('file')) {
                $filePortada = $request->file('file');
                $ubicacionPortada = 'public/podcasts/portadas';
                $url = $this->storeFile($filePortada, $ubicacionPortada);

                $podcast->imagen()->create([
                    'url' => $url,
                    'imageable_type' => Podcast::class,
                ]);
            }

            DB::commit();
            Cache::flush();

            // Redireccionar con un mensaje de éxito
            return redirect()
                ->route('admin.podcasts.index')
                ->with('success', 'Podcast creado exitosamente.');
        } catch (\Exception $e) {
            // Revertir la transacción en caso de error
            DB::rollBack();
            Log::error('Error al store - Podcast: ' . $e->getMessage());

            // Redireccionar con un mensaje de error y mantener los datos de entrada
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Error al crear el Podcast: ' . $e->getMessage());
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(Podcast $podcast)
    {
        //return view('admin.podcast.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Podcast $podcast)
    {
        $comites = Comite::selectList()->get();
        $categorias = Categoria::selectList()->get();
        return view('admin.podcasts.edit', [
            'podcast' => $podcast,
            'comites' => $comites,
            'categorias' => $categorias,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PodcastRequest $request, Podcast $podcast)
    {
        try {
            // Iniciar una transacción de base de datos
            DB::beginTransaction();

            $url_banner = $podcast->imagen_banner;

            // Verificar si se cargó un nuevo banner
            if ($request->hasFile('imagen_banner')) {
                $fileBanner = $request->file('imagen_banner');
                $ubicacionBanner = 'public/podcast/banner';
                $url_banner = $this->storeFile($fileBanner, $ubicacionBanner);

                // Eliminar el banner anterior si existe
                if ($podcast->imagen_banner) {
                    Storage::delete($podcast->imagen_banner);
                }
            }

            $podcast->update([
                'titulo' => $request->titulo,
                'slug' => $request->slug,
                'descripcion' => $request->descripcion,
                'contenido' => $request->contenido,
                'imagen_banner' => $url_banner,
                'comite_id' => $request->comite,
                'categoria_id' => $request->categoria,
                'estado' => 'Publicado',
            ]);

            // Verificar si se cargó un nuevo archivo
            if ($request->hasFile('file')) {
                $filePortada = $request->file('file');
                $ubicacionPortada = 'public/podcasts/portadas';
                $url = $this->storeFile($filePortada, $ubicacionPortada);

                if ($podcast->imagen) {
                    Storage::delete($podcast->imagen->url);

                    // Actualizar la relación de imagen con la nueva URL del archivo
                    $podcast->imagen()->update([
                        'url' => $url,
                        'imageable_type' => Podcast::class,
                    ]);
                } else {
                    // Si el podcast no tiene una imagen, agregar una nueva imagen
                    $podcast->imagen()->create([
                        'url' => $url,
                        'imageable_type' => Podcast::class,
                    ]);
                }
            }

            DB::commit();
            Cache::flush();

            // Redireccionar con un mensaje de éxito
            return redirect()
                ->route('admin.podcasts.edit', $podcast)
                ->with('success', 'Podcast actualizado exitosamente.');
        } catch (\Exception $e) {
            // Revertir la transacción en caso de error
            DB::rollBack();
            Log::error('Error  update - Podcast: ' . $e->getMessage());

            // Redireccionar con un mensaje de error
            return redirect()
                ->back()
                ->with('error', 'Error al actualizar el Podcast: ' . $e->getMessage())->withInput();
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Podcast $podcast)
    {
        DB::beginTransaction();

        try {
            // Eliminar el banner del podcast, si existe
            if ($podcast->imagen_banner) {
                $this->deleteFile($podcast->imagen_banner);
            }

            // Eliminar todas las imágenes de portada asociadas al podcast, si las hay
            if ($podcast->imagen()->exists()) {
                foreach ($podcast->imagen()->get() as $imagen) {
                    $this->deleteFile($imagen->url);
                    $imagen->delete(); // Eliminar la entrada de la base de datos
                }
            }

            // Eliminar el podcast
            $podcast->delete();
            DB::commit();
            Cache::flush();

            // Redireccionar con un mensaje de éxito
            return redirect()
                ->route('admin.podcasts.index')
                ->with('success', 'Podcast eliminado exitosamente.');
        } catch (\Exception $e) {
            DB::rollBack();

            // Redireccionar con un mensaje de error
            return redirect()
                ->back()
                ->with('error', 'No se pudo eliminar el Podcast.');
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

    //LISTAR LOS EPISODIOS SEGUN EL PODCAST
    public function listEpisodio(Podcast $podcast)
    {
        //CACHE
        $podcast_id = $podcast->id;
        $cache_key = 'admin.episodios.' . $podcast_id;

        if (Cache::has($cache_key)) {
            $episodios = Cache::get($cache_key);
        } else {
            $episodios = Episodio::ListarEpisodioPodcast($podcast_id)->get();
            Cache::put($cache_key, $episodios);
        }


        return view('admin.podcasts.episodio', [
            'podcast' => $podcast,
            'episodios' => $episodios,
        ]);
    }


    public function createEpisodio(Podcast $podcast)
    {
        return view('admin.episodios.create', [
            'podcast' => $podcast,
        ]);
    }
}
