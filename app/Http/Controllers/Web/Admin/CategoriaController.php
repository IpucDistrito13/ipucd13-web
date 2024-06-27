<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoriaRequest;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        //CACHE
        if (Cache::has('categorias')) {
            $categorias = Cache::get('categorias');
        } else {
            $categorias = Categoria::ListarCategorias()->latest()->get();
            Cache::put('categorias', $categorias);
        }
        //CACHE

        //$categorias = Categoria::activos()->get();
        return view('admin.categorias.index', compact('categorias'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categorias.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoriaRequest $request)
    {

        $url_banner = '';
        if ($request->hasFile('imagen_banner')) {
            //$url_banner = Storage::put('public/categorias/banner', $request->file('imagen_banner'));
            $ubicacion = 'public/categorias/banner';
            if (env('APP_ENV') === 'local') {
                $url = Storage::put($ubicacion, $request->file('file'));
            } else {
                $url = Storage::disk('s3')->put($ubicacion, $request->file('file'));
            }
        }

        $data = [
            'nombre' => $request->nombre,
            'slug' => $request->slug,
            'descripcion' => $request->descripcion,
            'imagen_banner' => $url_banner
        ];


        $categoria = Categoria::create($data);

        if ($request->file('file')) {
            //$url = Storage::put('public/categorias', $request->file('file'));
            $ubicacion = 'public/categorias';
            if (env('APP_ENV') === 'local') {
                $url = Storage::put($ubicacion, $request->file('file'));
            } else {
                $url = Storage::disk('s3')->put($ubicacion, $request->file('file'));
            }

            $categoria->imagen()->create([
                'url' => $url,
                'imageable_type' => Categoria::class,
            ]);
        }

        //Elimina datos cache
        Cache::flush();
        //Cache

        $data = [
            'message' => 'Categoría creada exitosamente.',
        ];

        return redirect()->route('admin.categorias.index')->with('success', $data['message']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Categoria $categoria)
    {
        return view('admin.categorias.show', compact('categoria'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Categoria $categoria)
    {
        return view('admin.categorias.edit', compact('categoria'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoriaRequest $request, Categoria $categoria)
    {

        $url_banner = $categoria->imagen_banner; // Obtener la URL actual del banner

        // Verificar si se cargó un nuevo banner
        if ($request->hasFile('imagen_banner')) {
            // Si se cargó un nuevo banner, almacenar y obtener su URL
            //$url_banner = Storage::put('public/categorias/banner', $request->file('imagen_banner'));
            $ubicacion = 'public/categorias/banner';
            if (env('APP_ENV') === 'local') {
                $url = Storage::put($ubicacion, $request->file('file'));
            } else {
                $url = Storage::disk('s3')->put($ubicacion, $request->file('file'));
            }
            
            // Eliminar el banner anterior si existe
            if ($categoria->imagen_banner) {
                Storage::delete($categoria->imagen_banner);
            }
        }

        $data = [
            'nombre' => $request->nombre,
            'slug' => $request->slug,
            'descripcion' => $request->descripcion,
            'imagen_banner' => $url_banner,
        ];

        $categoria->update($data);

        ///////////// MORPHO IMAGE

        // Verificar si se cargó un nuevo archivo
        if ($request->file('file')) {

            //$url = Storage::put('public/categorias', $request->file('file'));
            $ubicacion = 'public/categorias';
            if (env('APP_ENV') === 'local') {
                $url = Storage::put($ubicacion, $request->file('file'));
            } else {
                $url = Storage::disk('s3')->put($ubicacion, $request->file('file'));
            }

            // Si la categoría ya tiene una imagen, eliminar el archivo antiguo
            if ($categoria->imagen) {
                Storage::delete($categoria->imagen->url);

                // Actualizar la relación de imagen con la nueva URL del archivo
                $categoria->imagen()->update([
                    'url' => $url,
                    'imageable_type' => Categoria::class,
                ]);
            } else {
                // Si la categoría no tiene una imagen, agregar una nueva imagen
                $categoria->imagen()->create([
                    'url' => $url,
                    'imageable_type' => Categoria::class,
                ]);
            }
        }

        //Elimina datos cache
        Cache::flush();
        //Cache

        // Redireccionar con un mensaje de éxito
        $data = [
            'message' => 'Categoría actualizada exitosamente.'
        ];
        return redirect()->route('admin.categorias.edit', $categoria)->with('success', $data['message']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Categoria $categoria)
    {
        $categoria->delete();
        $data = [
            'message' => 'Categoría eliminada exitosamente.',
        ];

        //Elimina datos cache
        Cache::flush();
        //Cache

        return redirect()->route('admin.categorias.index')->with('success', $data['message']);
    }
}
