<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\EpisodioRequest;
use App\Models\Episodio;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;


class EpisodioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return  $episodios = Episodio::with('podcast:id,titulo')
            ->select('id', 'titulo', 'slug', 'descripcion', 'podcast_id')->get();
        return view('admin.episodios.index', [
            'episodios' => $episodios,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.episodios.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {


        $request->validate([
            //'file.*' => 'required|mimes:mp3,ogg,wav', // Asegúrate de validar el tipo de archivo correcto
            'titulo' => 'required|string|max:255',
            'slug' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            //'podcast' => 'required|exists:podcasts,id', // Asegúrate de que el podcast exista en la base de datos
        ]);

        $episodio = Episodio::create([
            'titulo' => $request->titulo,
            'slug' => $request->slug,
            'descripcion' => $request->descripcion,
            'url' => $request->url,
            'podcast_id' => $request->podcast,
        ]);

        Cache::flush();

        $data = ['message' => 'Episodio creado exitosamente.'];

        return back()->with('success', $data['message']);
    }


    /**
     * Display the specified resource.
     */
    public function show(Episodio $episodio)
    {
        //return view('admin.solicitud_types.show', compact('solicitud_type'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Episodio $episodio)
    {
        return view('admin.episodios.edit', compact('episodio'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Episodio $episodio)
    {
        $episodio->update([
            'titulo' => $request->titulo,
            'slug' => $request->slug,
            'descripcion' => $request->descripcion,
            'podcast_id' => $request->podcast,
        ]);

        $data = [
            'message' => 'Episodio actualizado exitosamente.',
        ];
        return redirect()->route('admin.episodios.edit', $episodio)->with('success', $data['message']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Episodio $episodio)
    {
        try {
            $episodio->delete();

            $data = [
                'message' => 'Episodio eliminado exitosamente.',
            ];

            return back()->with('success', $data['message']);
        } catch (\Exception $e) {
            $data = [
                'message' => 'No se pudo eliminar el episodio, debido a restricción de integridad.',
            ];

            return back()->with('error', $data['message']);

            // return redirect()->route('admin.episodio.index')->with('error', $data['message']);
            //return back()->with('success', $data['message']);

        }
    }

    public function apigetAudio($episodioid)
    {
        // return 'Hola'; // Elimina o comenta esta línea
        $audio = Episodio::select('id', 'url', 'titulo')->where('id', $episodioid)->first();
        return $audio;
    }

    public function upload(Request $request)
    {
        // Validar la solicitud
        $podcast = $request->input('podcast');

        // Verificar si el archivo existe en la solicitud
        if ($request->hasFile('file')) {
            $file = $request->file('file');

            // Generar un nombre de archivo único
            $fileName = time() . '-' . $file->getClientOriginalName();

            // Validar el tipo de galería y definir la ruta de almacenamiento
            $url = $file->storeAs('public/podcast/' . $podcast, $fileName);

            if (!$url) {
                return response()->json(['error' => 'Error al almacenar el archivo.'], 500);
            }

            // Generar UUID
            $uuid = (string) Str::uuid();

            // Crear el array de datos para guardar en la base de datos
            $data = [
                'url' => $url,
                'filetable_id' => $podcast,
                'filetipe_type' => Episodio::class,
            ];

            // Crear el registro en la base de datos
            try {
                $galeria = Episodio::create($data);
                return response()->json(['message' => 'Se cargo el audio exitosamente.', 'uuid' => $uuid], 200);
            } catch (\Exception $e) {
                return response()->json(['error' => 'Error al guardar en la base de datos: ' . $e->getMessage()], 500);
            }
        } else {
            return response()->json(['error' => 'No se ha cargado ningún archivo.'], 400);
        }
    }

    /*
    public function upload(Request $request)
    {
        if ($request->hasFile('file')) {
            $url = Storage::put('public/episodio', $request->file('file'));

            $episodio = Episodio::create([
                'titulo' => $request->titulo,
                'slug' => $request->slug,
                'descripcion' => $request->descripcion,
                'podcast_id' => $request->podcast,
            ]);

            $episodio->imagen()->create([
                'url' => $url,
                'imageable_type' => Episodio::class,
            ]);

            // Aquí puedes procesar y guardar el archivo

            // Por ahora, solo imprimimos los datos, pero puedes guardarlos en la base de datos, por ejemplo
            return "Guardado exitosamente.";
        } else {
            return "No se ha enviado ningún archivo.";
        }
    }
    */
}
