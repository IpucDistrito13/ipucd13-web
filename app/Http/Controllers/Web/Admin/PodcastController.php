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

    /**
     * Store a newly created resource in storage.
     */
    public function store(PodcastRequest $request)
    {
        $url_banner = '';
        if ($request->hasFile('imagen_banner')) {
            $url_banner = Storage::put('public/podcasts/banner', $request->file('imagen_banner'));
        }

        $podcast = Podcast::create([
            'titulo' => $request->titulo,
            'slug' => $request->slug,
            'descripcion' => $request->descripcion,
            'contenido' => $request->contenido,
            'imagen_banner' => $url_banner,

            'comite_id' => $request->comite,
            'categoria_id' => $request->categoria,
            'estado' => 'Publicado',
            'user_id' => auth()->user()->id, // Corrected the user ID access
        ]);

        if ($request->file('file')) {
            $url = Storage::put('public/podcasts', $request->file('file'));

            $podcast->imagen()->create([
                'url' => $url,
                'imageable_type' => Podcast::class,
            ]);
        }

        Cache::flush();

        $data = [
            'message' => 'Podcast creado exitosamente.',
        ];

        return redirect()->route('admin.podcasts.index')->with('success', $data['message']);
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
        $url_banner = $podcast->imagen_banner; // Obtener la URL actual del banner

        // Verificar si se cargó un nuevo banner
        if ($request->hasFile('imagen_banner')) {
            // Si se cargó un nuevo banner, almacenar y obtener su URL
            $url_banner = Storage::put('public/podcast/banner', $request->file('imagen_banner'));

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
        if ($request->file('file')) {
            $url = Storage::put('public/podcasts', $request->file('file'));

            // Si la categoría ya tiene una imagen, eliminar el archivo antiguo
            if ($podcast->imagen) {
                Storage::delete($podcast->imagen->url);

                // Actualizar la relación de imagen con la nueva URL del archivo
                $podcast->imagen()->update([
                    'url' => $url,
                    'imageable_type' => Podcast::class,
                ]);
            } else {
                // Si la categoría no tiene una imagen, agregar una nueva imagen
                $podcast->imagen()->create([
                    'url' => $url,
                    'imageable_type' => Podcast::class,
                ]);
            }
        }

        Cache::flush();

        // Redireccionar con un mensaje de éxito
        $data = [
            'message' => 'Podcast actualizado exitosamente.'
        ];
        return redirect()->route('admin.podcasts.edit', $podcast)->with('success', $data['message']);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Podcast $podcast)
    {
        try {
            $podcast->delete();

            $data = [
                'message' => 'Podcast eliminado exitosamente.',
            ];

            //Elimina la variables almacenada en cache
            Cache::flush();
            //Cache

            return redirect()->route('admin.podcasts.index')->with('success', $data['message']);
        } catch (\Exception $e) {
            $data = [
                'message' => 'No se pudo eliminar el podcast, debido a restricción de integridad.',
            ];

            //Elimina la variables almacenada en cache
            Cache::flush();
            //Cache

            return redirect()->route('admin.podcasts.index')->with('error', $data['message']);
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

        //CACHE

        return view('admin.podcasts.episodio', [
            'podcast' => $podcast,
            'episodios' => $episodios,
        ]);
    }


    public function createEpisodio(Podcast $podcast)
    {
        // return $podcast;
        //$episodios = Episodio::where('podcast_id', $podcast->id)->get();
        return view('admin.episodios.create', [
            'podcast' => $podcast,
        ]);
    }
}
