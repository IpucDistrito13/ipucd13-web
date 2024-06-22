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
        $content = $request->contenido;
        $dom = new \DomDocument();
        $dom->loadHtml($content, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $imageFile = $dom->getElementsByTagName('img');

        foreach ($imageFile as $item => $image) {
            $data = $image->getAttribute('src');
            list($type, $data) = explode(';', $data);
            list(, $data) = explode(',', $data);
            $imgeData = base64_decode($data);

            // Define the directory and ensure it exists
            $directory = public_path('publicaciones/upload');
            if (!is_dir($directory)) {
                mkdir($directory, 0755, true); // Creates the directory with appropriate permissions
            }

            // Generate the image name and path
            $image_name = "/publicaciones/upload/" . time() . $item . '.png';
            $path = $directory . '/' . time() . $item . '.png';


            // Save the image
            file_put_contents($path, $imgeData);

            // Update the image src attribute
            $image->removeAttribute('src');
            $image->setAttribute('src', $image_name);
        }

        $content = $dom->saveHTML();

        $post = Publicacion::create([
            'titulo' => $request->titulo,
            'slug' => $request->slug,
            'descripcion' => $request->descripcion,
            'contenido' => $content, // Save the modified content
            'comite_id' => $request->comite,
            'categoria_id' => $request->categoria,
            'estado' => $request->estado,
            'user_id' => auth()->user()->id,
        ]);

        if ($request->file('file')) {
            $url = Storage::put('public/publicaciones', $request->file('file'));

            $post->imagen()->create([
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

    public function update(Request $request, Publicacion $publicacion)
    {
        $content = $request->contenido;
        $dom = new \DomDocument();
        $dom->loadHtml($content, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $imageFile = $dom->getElementsByTagName('img');

        foreach ($imageFile as $item => $image) {
            $data = $image->getAttribute('src');

            if (strpos($data, 'data:image') === 0) {
                list($type, $data) = explode(';', $data);
                list(, $data) = explode(',', $data);
                $imageData = base64_decode($data);

                // Define the directory and ensure it exists
                $directory = public_path('publicaciones/upload');
                if (!is_dir($directory)) {
                    mkdir($directory, 0755, true);
                }

                // Generate the image name and path
                $image_name = "/publicaciones/upload/" . time() . $item . '.png';
                $path = $directory . '/' . time() . $item . '.png';

                // Save the image
                file_put_contents($path, $imageData);

                // Update the image src attribute
                $image->removeAttribute('src');
                $image->setAttribute('src', $image_name);
            }
        }

        $content = $dom->saveHTML();

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

        if ($request->file('file')) {
            // Delete the old image if it exists
            if ($publicacion->imagen) {
                Storage::delete($publicacion->imagen->url);
                $publicacion->imagen()->delete();
            }

            // Store the new image
            $url = Storage::put('public/publicaciones', $request->file('file'));

            $publicacion->imagen()->create([
                'url' => $url,
                'imageable_type' => Publicacion::class,
            ]);
        }

        $data = [
            'message' => 'Publicación actualizada exitosamente.',
        ];

        // Elimina las variables almacenadas en cache
        Cache::flush();

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
