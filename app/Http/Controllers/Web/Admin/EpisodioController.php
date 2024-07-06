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
use Pion\Laravel\ChunkUpload\Handler\HandlerFactory;
use Pion\Laravel\ChunkUpload\Receiver\FileReceiver;

class EpisodioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    /*
    public function index()
    {
        return  $episodios = Episodio::with('podcast:id,titulo')
            ->select('id', 'titulo', 'slug', 'descripcion', 'podcast_id')->get();

        return view('admin.episodios.index', [
            'episodios' => $episodios,
        ]);
    }
    */

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

        $data = ['message' => 'Episodio creado exitosamente.'];

        Cache::flush();


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

        Cache::flush();

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

            Cache::flush();


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

    public function uploadUrl(Request $request)
    {
        // Validar los datos de la solicitud
        $request->validate([
            'podcast' => 'required|exists:episodios,id', // Asegurarse de que el podcast exista
            'file' => 'required|mimes:mp3'    // Asegurarse de que el archivo sea un mp3 y no exceda los 20MB
        ]);

        $podcast = $request->podcast;
        $episodio = Episodio::find($podcast);

        // Verificar si el archivo existe en la solicitud
        if ($request->hasFile('file')) {
            $file = $request->file('file');

            // Generar un nombre de archivo único
            $fileName = time() . '-' . $file->getClientOriginalName();

            // Almacenar el archivo en el almacenamiento público
            $url = $file->storeAs('public/podcasts/episodio/' . $podcast, $fileName);
            $data = [
                'url' => $url,
            ];

            // Actualizar la URL del episodio
            $episodio->url = Storage::url($url);
            $episodio->save($data);

            Cache::flush();

            return response()->json(['message' => 'Archivo cargado exitosamente'], 200);
        } else {
            // Manejar el caso en el que no se presente ningún archivo en la solicitud
            return response()->json(['error' => 'No se ha cargado ningún archivo'], 400);
        }
    }

    public function uploadFile()
    {
        return 'Hola';
        return view('admin.podcasts.upload');

    }

    public function testFile(Request $request, $episodioId)
    {
        //return $episodioId;
        return view('admin.podcasts.upload');

    }


    private function storeFile($file, $ubicacion)
    {
        $contents = file_get_contents($file->getRealPath());

        if (env('APP_ENV') === 'local') {
            return Storage::put($ubicacion, $contents);
        } else {
            return Storage::disk('s3')->put($ubicacion, $contents);
        }
    }

    public function uploadLargeFiles(Request $request)
    {
      $episodioId = $request->episodioId;
      //return  $episodio = Episodio::findOrFail($episodioId);

        $receiver = new FileReceiver('file', $request, HandlerFactory::classFromRequest($request));
    
        if (!$receiver->isUploaded()) {
            return response()->json(['error' => 'File not uploaded'], 400);
        }
    
        $fileReceived = $receiver->receive();
        if ($fileReceived->isFinished()) {
            $file = $fileReceived->getFile();
            $extension = $file->getClientOriginalExtension();
            $fileName = str_replace('.' . $extension, '', $file->getClientOriginalName());
            $fileName .= '_' . md5(time()) . '.' . $extension;
    
            $ubicacion = 'public/podcasts/episodios/' . $fileName;
            $this->storeFile($file, $ubicacion);
    
            unlink($file->getPathname());
    
            $storagePath = '';
    
            if (env('APP_ENV') === 'local') {
                $storagePath = asset('storage/podcasts/episodios/' . $fileName);
            } else {
                $storagePath = 'https://ipucd13.nyc3.digitaloceanspaces.com/' . $ubicacion;
            }
    
            $data = [
                'url' => $storagePath,
            ];

            $episodio = Episodio::find($episodioId);
            $episodio->url = $storagePath;
            $episodio->save($data);

            Cache::flush();
    
            return [
                'path' => $storagePath,
                'filename' => $fileName
            ];
        }
    
        $handler = $fileReceived->handler();
        return [
            'done' => $handler->getPercentageDone(),
            'status' => true
        ];
    }

    public function uploadLargeFilesAux(Request $request)
    {
        $receiver = new FileReceiver('file', $request, HandlerFactory::classFromRequest($request));
    
        if (!$receiver->isUploaded()) {
            return response()->json(['error' => 'File not uploaded'], 400);
        }
    
        $fileReceived = $receiver->receive();
        if ($fileReceived->isFinished()) {
            $file = $fileReceived->getFile();
            $extension = $file->getClientOriginalExtension();
            $fileName = str_replace('.' . $extension, '', $file->getClientOriginalName());
            $fileName .= '_' . md5(time()) . '.' . $extension;
    
            $ubicacion = 'public/podcasts/episodios/' . $fileName;
            $this->storeFile($file, $ubicacion);
    
            unlink($file->getPathname());
    
            $storagePath = '';
    
            if (env('APP_ENV') === 'local') {
                $storagePath = asset('storage/podcasts/episodios/' . $fileName);
            } else {
                $storagePath = 'https://ipucd13.nyc3.digitaloceanspaces.com/' . $ubicacion;
            }
    
            $data = [
                'url' => $storagePath,
            ];

            $episodioId = 1;
            $episodio = Episodio::find($episodioId);
            $episodio->url = $storagePath;
    
            $episodio->save($data);
            Cache::flush();
    
            return [
                'path' => $storagePath,
                'filename' => $fileName
            ];
        }
    
        $handler = $fileReceived->handler();
        return [
            'done' => $handler->getPercentageDone(),
            'status' => true
        ];
    }
}
