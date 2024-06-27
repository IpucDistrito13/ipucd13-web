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
    public function store(CategoriaRequest $request)
    {
        $url_banner = '';

        // Verificar si se cargó un nuevo banner
        if ($request->hasFile('imagen_banner')) {
            $fileBanner = $request->file('imagen_banner');
            $ubicacionBanner = 'public/categorias/banner';
            $url_banner = $this->storeFile($fileBanner, $ubicacionBanner);
        }

        $data = [
            'nombre' => $request->nombre,
            'slug' => $request->slug,
            'descripcion' => $request->descripcion,
            'imagen_banner' => $url_banner,
        ];

        $categoria = Categoria::create($data);

        // Verificar si se cargó un nuevo archivo
        if ($request->hasFile('file')) {
            $filePortada = $request->file('file');
            $ubicacionPortada = 'public/categorias';
            $url = $this->storeFile($filePortada, $ubicacionPortada);

            $categoria->imagen()->create([
                'url' => $url,
                'imageable_type' => Categoria::class,
            ]);
        }

        // Elimina datos cache
        Cache::flush();

        // Redireccionar con un mensaje de éxito
        return redirect()->route('admin.categorias.index')->with('success', 'Categoría creada exitosamente.');
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
            $fileBanner = $request->file('imagen_banner');
            $ubicacionBanner = 'public/categorias/banner';

            if ($fileBanner->isValid()) {
                $url_banner = $this->storeFile($fileBanner, $ubicacionBanner);

                // Eliminar el banner anterior si existe
                if ($categoria->imagen_banner) {
                    Storage::delete($categoria->imagen_banner);
                }
            } else {
                return response()->json(['error' => 'El archivo no es válido.'], 400);
            }
        }

        // Verificar si se cargó un nuevo archivo
        if ($request->hasFile('file')) {
            $filePortada = $request->file('file');
            $ubicacionPortada = 'public/categorias';
            $url = $this->storeFile($filePortada, $ubicacionPortada);

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

        // Actualizar los datos de la categoría
        $categoria->update([
            'nombre' => $request->nombre,
            'slug' => $request->slug,
            'descripcion' => $request->descripcion,
            'imagen_banner' => $url_banner,
        ]);

        Cache::flush();

        return redirect()->route('admin.categorias.edit', $categoria)->with('success', 'Categoría actualizada exitosamente.');
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

        Cache::flush();

        return redirect()->route('admin.categorias.index')->with('success', $data['message']);
    }
}
