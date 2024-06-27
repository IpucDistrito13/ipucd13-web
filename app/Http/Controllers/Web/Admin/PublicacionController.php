<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
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

    public function store(Request $request)
    {
        try {
            // Procesar el contenido HTML para manejar imágenes base64
            $content = $this->processBase64Images($request->contenido);

            // Crear la publicación con los datos proporcionados
            $post = Publicacion::create([
                'titulo' => $request->titulo,
                'slug' => $request->slug,
                'descripcion' => $request->descripcion,
                'contenido' => $content,
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
                $post->imagen()->create([
                    'url' => $url,
                    'imageable_type' => Publicacion::class,
                ]);
            }

            // Limpiar la cache
            Cache::flush();

            // Redireccionar con mensaje de éxito
            return redirect()->route('admin.publicaciones.index')->with('success', 'Publicación creada exitosamente.');
        } catch (\Exception $e) {
            // En caso de error, redireccionar con mensaje de error
            return redirect()->back()->with('error', 'Error al crear la publicación: ' . $e->getMessage())->withInput();
        }
    }

    private function processBase64Images3($content)
    {
        $dom = new \DomDocument();
        $dom->loadHtml($content, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $imageFile = $dom->getElementsByTagName('img');

        foreach ($imageFile as $item => $image) {
            $data = $image->getAttribute('src');
            list($type, $data) = explode(';', $data);
            list(, $data) = explode(',', $data);
            $imageData = base64_decode($data);

            // Define the directory and ensure it exists
            $directory = public_path('publicaciones/uploads');
            if (!is_dir($directory)) {
                mkdir($directory, 0755, true); // Crea el directorio con permisos adecuados
            }

            // Generar el nombre y la ruta de la imagen
            $image_name = "/publicaciones/uploads/" . time() . $item . '.png';
            $path = $directory . '/' . time() . $item . '.png';

            // Guardar la imagen en disco
            file_put_contents($path, $imageData);

            // Actualizar el atributo src de la imagen en el contenido HTML
            $image->removeAttribute('src');
            $image->setAttribute('src', $image_name);
        }

        // Devolver el contenido modificado como HTML
        return $dom->saveHTML();
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
        //return $publicacion;
        return view('admin.publicaciones.edit', compact('publicacion', 'comites', 'categorias'));
    }

    public function update(Request $request, Publicacion $publicacion)
    {
        try {
            // Obtener y limpiar el contenido HTML
            $content = $request->contenido;

            // Validar y limpiar el HTML utilizando un helper o una función de sanitización adecuada
            $content = $this->sanitizeHTML($content);

            // Procesar el contenido HTML para manejar imágenes base64, si es necesario
            $content = $this->processBase64Images($content);

            // Actualizar la publicación con los datos proporcionados
            $publicacion->update([
                'titulo' => $request->titulo,
                'slug' => $request->slug,
                'descripcion' => $request->descripcion,
                'contenido' => $content,
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
            return redirect()->route('admin.publicaciones.index')->with('success', 'Publicación actualizada exitosamente.');
        } catch (\Exception $e) {
            // En caso de error, redireccionar con mensaje de error
            return redirect()->back()->with('error', 'Error al actualizar la publicación: ' . $e->getMessage())->withInput();
        }
    }

    private function sanitizeHTML($html)
    {
        // Aquí puedes implementar una lógica para limpiar y validar el HTML según tus necesidades.
        // Puedes usar una biblioteca de sanitización como HTMLPurifier o implementar tu propia función de limpieza.

        // Ejemplo básico de limpieza utilizando strip_tags para eliminar etiquetas no permitidas.
        $allowedTags = '<p><a><strong><em><ul><ol><li><img><iframe>'; // Agrega <iframe> para permitir videos de YouTube u otros
        $html = strip_tags($html, $allowedTags);

        return $html;
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
