<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PublicacionRequest;
use App\Models\Categoria;
use App\Models\Comite;
use App\Models\Publicacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use DOMDocument;


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
            $publicaciones = Publicacion::with('categoria')->ListarPublicaciones()->get();
            Cache::put('publicaciones', $publicaciones);
        }
        //CACHE

        return view('admin.publicaciones.index', [
            'publicaciones' => $publicaciones
        ]);
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

    public function store(Request $request)
    {
        try {
            $contenido = $request->contenido;

            // Configurar la entrada como UTF-8 para asegurar el manejo adecuado de caracteres especiales
            $dom = new \DOMDocument('1.0', 'UTF-8');
            libxml_use_internal_errors(true);
            $dom->loadHTML(mb_convert_encoding($contenido, 'HTML-ENTITIES', 'UTF-8'), LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
            libxml_clear_errors();
            $contenido = $dom->saveHTML();

            // Procesar el contenido HTML para manejar imágenes base64, si es necesario
            $contenido = $this->processBase64Images($contenido);

            // Crear la nueva publicación con los datos proporcionados
            $publicacion = Publicacion::create([
                'titulo' => $request->titulo,
                'slug' => $request->slug,
                'descripcion' => $request->descripcion,
                'contenido' => $contenido,
                'comite_id' => $request->comite,
                'categoria_id' => $request->categoria,
                'estado' => $request->estado,
                'user_id' => auth()->user()->id,
            ]);

            // Manejar la imagen asociada, si se proporciona
            if ($request->file('file')) {
                $filePortada = $request->file('file');
                $ubicacionPortada = 'public/publicaciones/portadas';
                $url = $this->storeFile($filePortada, $ubicacionPortada);
                $publicacion->imagen()->create([
                    'url' => $url,
                    'imageable_type' => Publicacion::class,
                ]);
            }

            // Limpiar la cache
            Cache::flush();

            // Redireccionar con mensaje de éxito
            return redirect()->route('admin.publicaciones.index')
                ->with('success', 'Publicación creada exitosamente.');
        } catch (\Exception $e) {
            // Log del error para revisión posterior
            \Log::error('Error al crear la publicación: ' . $e->getMessage());

            // Redireccionar con mensaje de error
            return redirect()->back()
                ->withInput()
                ->with('error', 'Ha ocurrido un error al crear la publicación. Por favor, inténtelo de nuevo.');
            //->with('error', $e->getMessage());
        }
    }




    public function store22(PublicacionRequest $request)
    {
        try {
            $contenido = $request->contenido;
            $dom = new DOMDocument();
            libxml_use_internal_errors(true);
            $dom->loadHTML($contenido, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
            libxml_clear_errors();
            $contenido = $dom->saveHTML();

            // Procesar el contenido HTML para manejar imágenes base64, si es necesario
            $contenido = $this->processBase64Images($contenido);

            // Crear la publicación con los datos proporcionados
            $publicacion = Publicacion::create([
                'titulo' => $request->titulo,
                'slug' => $request->slug,
                'descripcion' => $request->descripcion,
                'contenido' => $contenido,
                'comite_id' => $request->comite,
                'categoria_id' => $request->categoria,
                'estado' => $request->estado,
                'user_id' => auth()->user()->id,
            ]);

            // Manejar la imagen de portada si se proporciona
            if ($request->hasFile('file')) {
                $filePortada = $request->file('file');
                $ubicacionPortada = 'public/publicaciones/portadas';
                $url = $this->storeFile($filePortada, $ubicacionPortada);
                $publicacion->imagen()->create([
                    'url' => $url,
                    'imageable_type' => Publicacion::class,
                ]);
            }

            Cache::flush();

            // Redireccionar con mensaje de éxito
            return redirect()->route('admin.publicaciones.index')
                ->with('success', 'Publicación creada exitosamente.');
        } catch (\Exception $e) {
            // Log del error para revisión posterior
            \Log::error('Error al crear la publicación: ' . $e->getMessage());

            // Redireccionar con mensaje de error
            return redirect()->back()
                ->withInput()
                //->with('error', 'Ha ocurrido un error al crear la publicación. Por favor, inténtelo de nuevo.');
                ->with('error', $e->getMessage());
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
        return view('admin.publicaciones.edit', [
            'publicacion' => $publicacion,
            'comites' => $comites,
            'categorias' => $categorias
        ]);
    }

    public function update(Request $request, Publicacion $publicacion)
    {
        try {
            $contenido = $request->contenido;
            $dom = new DOMDocument();
            libxml_use_internal_errors(true);
            $dom->loadHTML($contenido, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
            libxml_clear_errors();
            $contenido = $dom->saveHTML();

            // Procesar el contenido HTML para manejar imágenes base64, si es necesario
            $contenido = $this->processBase64Images($contenido);

            // Actualizar la publicación con los datos proporcionados
            $publicacion->update([
                'titulo' => $request->titulo,
                'slug' => $request->slug,
                'descripcion' => $request->descripcion,
                'contenido' => $contenido,
                'comite_id' => $request->comite,
                'categoria_id' => $request->categoria,
                'estado' => $request->estado,
                'user_id' => auth()->user()->id,
            ]);

            // Manejar la imagen asociada, si se proporciona
            if ($request->file('file')) {
                // Eliminar la imagen antigua si existe
                if ($publicacion->imagen) {
                    Storage::delete($publicacion->imagen->url);
                    $publicacion->imagen()->delete();
                }

                // Almacenar la nueva imagen
                $filePortada = $request->file('file');
                $ubicacionPortada = 'public/publicaciones/portadas';
                $url = $this->storeFile($filePortada, $ubicacionPortada);
                $publicacion->imagen()->create([
                    'url' => $url,
                    'imageable_type' => Publicacion::class,
                ]);
            }

            // Limpiar la cache
            Cache::flush();

            // Redireccionar con mensaje de éxito
            return redirect()->route('admin.publicaciones.index')
                ->with('success', 'Publicación actualizada exitosamente.');
        } catch (\Exception $e) {
            // Log del error para revisión posterior
            \Log::error('Error al actualizar la publicación: ' . $e->getMessage());

            // Redireccionar con mensaje de error
            return redirect()->back()
                ->withInput()
                ->with('error', 'Ha ocurrido un error al actualizar la publicación. Por favor, inténtelo de nuevo.');
        }
    }

    private function processBase64Images($content)
    {
        $dom = new \DomDocument();
        libxml_use_internal_errors(true); // Desactivar los errores de libxml para evitar problemas con contenido HTML
        $dom->loadHtml($content, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $imageFile = $dom->getElementsByTagName('img');

        foreach ($imageFile as $item => $image) {
            $data = $image->getAttribute('src');

            if (strpos($data, 'data:image') === 0) {
                list($type, $data) = explode(';', $data);
                list(, $data) = explode(',', $data);
                $imageData = base64_decode($data);

                // Define the directory and ensure it exists
                $directory = public_path('publicaciones/uploads');
                if (!is_dir($directory)) {
                    mkdir($directory, 0755, true);
                }

                // Generate the image name and path
                $image_name = "/publicaciones/uploads/" . time() . $item . '.png';
                $path = $directory . '/' . time() . $item . '.png';

                // Save the image
                file_put_contents($path, $imageData);

                // Update the image src attribute
                $image->removeAttribute('src');
                $image->setAttribute('src', $image_name);
            }
        }

        // Devolver el contenido modificado como HTML
        return $dom->saveHTML();
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
