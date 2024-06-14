<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Models\Categoria;
use App\Models\Comite;
use App\Models\Serie;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class SerieController extends Controller
{
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



    public function indeasdsadx()
    {
        //CACHE
        if (Cache::has('series')) {
            $series = Cache::get('series');
        } else {
            $series = Serie::ListarSeries()->with('comite', 'categoria')->get();
            Cache::put('series', $series);
        }
        //CACHE

        return view('admin.series.index', compact('series'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $comites = Comite::selectList()->get();
        $categorias = Categoria::selectList()->get();
        return view('admin.series.create', compact('comites', 'categorias'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $url_banner = '';
        if ($request->hasFile('imagen_banner')) {
            $url_banner = Storage::put('public/comites/banner', $request->file('imagen_banner'));
        }

        $data = [
            'titulo' => $request->titulo,
            'slug' => $request->slug,
            'descripcion' => $request->descripcion,
            'contenido' => $request->contenido,
            'imagen_banner' => $url_banner,

            'comite_id' => $request->comite,
            'categoria_id' => $request->categoria,
            'estado' => 'Publicado',
            'user_id' => auth()->user()->id,
        ];

        $serie = Serie::create($data);

        // Morpho Image // 
        if ($request->file('file')) {
            $url = Storage::put('public/serie/', $request->file('file'));

            $serie->imagen()->create([
                'url' => $url,
                'imageable_type' => Serie::class,
            ]);
        }
        // Morpho Image // 

        $data = [
            'message' => 'Serie creada exitosamente.',
        ];

        //Elimina la variables almacenada en cache
        Cache::flush();
        //Cache

        return redirect()->route('admin.series.index')->with('success', $data['message']);
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
    public function edit(Serie $serie)
    {
        $comites = Comite::selectList()->get();
        $categorias = Categoria::selectList()->get();
        return view('admin.series.edit', compact('serie', 'comites', 'categorias'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Serie $serie)
    {
        $url_banner = $serie->imagen_banner;
        // Obtener la URL actual del banner

        // Verificar si se cargó un nuevo banner
        if ($request->hasFile('imagen_banner')) {
            // Si se cargó un nuevo banner, almacenar y obtener su URL
            $url_banner = Storage::put('public/serie/banner', $request->file('imagen_banner'));

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

        // MORPHO IMAGEN // 

        // Verificar si se cargó un nuevo archivo
        if ($request->file('file')) {

            $url = Storage::put('public/serie', $request->file('file'));

            // Si la serie ya tiene una imagen, eliminar el archivo antiguo
            if ($serie->imagen) {
                Storage::delete($serie->imagen->url);

                // Actualizar la relación de imagen con la nueva URL del archivo
                return   $serie->imagen()->update([
                    'url' => $url,
                    'imageable_type' => Serie::class,
                ]);
            } else {
                // Si EL serie no tiene una imagen, agregar una nueva imagen
                $serie->imagen()->create([
                    'url' => $url,
                    'imageable_type' => Serie::class,
                ]);
            }
        }
        // MORPHO IMAGEN // 

        $data = [
            'message' => 'Serie actualizada exitosamente.',
        ];

        //Elimina la variables almacenada en cache
        Cache::flush();
        //Cache

        return redirect()->route('admin.series.edit', $serie)->with('success', $data['message']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Serie $serie)
    {
        try {
            $serie->delete();

            $data = [
                'message' => 'Serie eliminada exitosamente.',
            ];

            //Elimina la variables almacenada en cache
            Cache::flush();
            //Cache

            return redirect()->route('admin.series.index')->with('success', $data['message']);
        } catch (\Exception $e) {
            $data = [
                'message' => 'No se pudo eliminar la serie, debido a restricción de integridad.',
            ];

            //Elimina la variables almacenada en cache
            Cache::flush();
            //Cache

            return redirect()->route('admin.series.index')->with('error', $data['message']);
        }
    }

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
