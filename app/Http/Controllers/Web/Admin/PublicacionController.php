<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Models\Categoria;
use App\Models\Comite;
use App\Models\Publicacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class PublicacionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //CACHE
        if (Cache::has('publicaciones')) {
            $publicaciones = Cache::get('publicaciones');
        } else {
            $publicaciones = Publicacion::ListarPublicaciones()->get();
            Cache::put('publicaciones', $publicaciones);
        }
        //CACHE

        //$publicacions = Publicacion::ListarPublicaciones()->get();
        return view('admin.publicaciones.index', compact('publicaciones'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $comites = Comite::selectList()->get();
        $categorias = Categoria::selectList()->get();
        return view('admin.publicaciones.create', compact('comites', 'categorias'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $publicacion = Publicacion::create([
            'titulo' => $request->titulo,
            'slug' => $request->slug,
            'descripcion' => $request->descripcion,
            'contenido' => $request->editordata,
            'comite_id' => $request->comite,
            'categoria_id' => $request->categoria,
            'estado' => $request->estado,
            'user_id' => auth()->user()->id,
        ]);

        if ($request->file('file')) {
            $url = Storage::put('public/publicaciones', $request->file('file'));

            $publicacion->imagen()->create([
                'url' => $url,
                'imageable_type' => Publicacion::class,
            ]);
        }

        $data = [
            'message' => 'Publicación creada exitosamente.',
        ];

        //Elimina la variables almacenada en cache
        Cache::flush();
        //Cache

        return redirect()->route('admin.publicaciones.index')->with('success', $data['message']);
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
    public function edit(Publicacion $publicacion)
    {
        $comites = Comite::selectList()->get();
        $categorias = Categoria::selectList()->get();
        //return $publicacion;
        return view('admin.publicaciones.edit', compact('publicacion', 'comites', 'categorias'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Publicacion $publicacion)
    {
        $publicacion->update($request->all());

        if ($request->file('file')) {
            $url = Storage::put('public/publicaciones', $request->file('file'));

            if ($publicacion->imagen) {
                Storage::delete($publicacion->imagen->url);
                $publicacion->imagen()->update([
                    'url' => $url,
                    'imageable_type' => Publicacion::class,
                ]);
            } else {
                // Si el usuario no tiene una imagen, agregar una nueva imagen
                $publicacion->imagen()->create([
                    'url' => $url,
                    'imageable_type' => Publicacion::class,
                ]);
            }
        }

        $data = [
            'message' => 'Publicación actualizada exitosamente.',
        ];

        //Elimina la variables almacenada en cache
        Cache::flush();
        //Cache

        return redirect()->route('admin.publicaciones.index')->with('success', $data['message']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Publicacion $publicacion)
    {
        try {
            $publicacion->delete();

            $data = [
                'message' => 'Publicación eliminada exitosamente.',
            ];

            //Elimina la variables almacenada en cache
            Cache::flush();
            //Cache

            return redirect()->route('admin.publicaciones.index')->with('success', $data['message']);
        } catch (\Exception $e) {
            $data = [
                'message' => 'No se pudo eliminar la publicación, debido a restricción de integridad.',
            ];

            //Elimina la variables almacenada en cache
            Cache::flush();
            //Cache

            return redirect()->route('admin.publicaciones.index')->with('error', $data['message']);
        }
    }
}
