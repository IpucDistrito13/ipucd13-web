<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\EpisodioRequest;
use App\Models\Episodio;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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
        return $request;
        
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
    public function update(EpisodioRequest $request, Episodio $episodio)
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

    // We are submitting are image along with userid and with the help of user id we are updateing our record
    public function storeImage(Request $request)
    {
        if ($request->file('file')) {

            $img = $request->file('file');

            //here we are geeting userid alogn with an image
            $userid = $request->userid;

            $imageName = strtotime(now()) . rand(11111, 99999) . '.' . $img->getClientOriginalExtension();
            $user_image = new User();
            $original_name = $img->getClientOriginalName();
            $user_image->image = $imageName;

            if (!is_dir(public_path() . '/uploads/images/')) {
                mkdir(public_path() . '/uploads/images/', 0777, true);
            }

            $request->file('file')->move(public_path() . '/uploads/images/', $imageName);

            // we are updating our image column with the help of user id
            $user_image->where('id', $userid)->update(['image' => $imageName]);

            return response()->json(['status' => "success", 'imgdata' => $original_name, 'userid' => $userid]);
        }
    }

    public function apigetAudio($episodioid)
    {
        // return 'Hola'; // Elimina o comenta esta línea
        $audio = Episodio::select('id', 'url', 'titulo')->where('id', $episodioid)->first();
        return $audio;
    }

    

    
}
