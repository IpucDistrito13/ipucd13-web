<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ComiteRequest;
use App\Models\Comite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;


class ComiteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //CACHE
        if (Cache::has('comites')) {
            $comites = Cache::get('comites');
        } else {
            $comites = Comite::ListarComites()->get();
            Cache::put('comites', $comites);
        }
        //CACHE

        return view('admin.comites.index', compact('comites'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
        return view('admin.comites.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ComiteRequest $request)
    {
        try {
            // Iniciar una transacción de base de datos
            DB::beginTransaction();

            $url_banner = '';
            if ($request->hasFile('imagen_banner')) {
                $url_banner = Storage::put('public/comites/banner', $request->file('imagen_banner'));
            }

            $data = [
                'nombre' => $request->nombre,
                'slug' => $request->slug,
                'descripcion' => $request->descripcion,
                'imagen_banner' => $url_banner,
            ];

            // Crear el comité
            $comite = Comite::create($data);

            // Morpho Image
            if ($request->file('file')) {
                $url = Storage::put('public/comites', $request->file('file'));

                $comite->imagen()->create([
                    'url' => $url,
                    'imageable_type' => Comite::class,
                ]);
            }
            // Fin Morpho Image

            // Commit si no hay errores
            DB::commit();

            //Elimina la variables almacenada en cache
            Cache::flush();
            //Cache

            $data = [
                'message' => 'Comité creado exitosamente.',
            ];

            return redirect()->route('admin.comites.index')->with('success', $data['message']);
        } catch (\Exception $e) {
            // Revertir la transacción en caso de error
            DB::rollBack();

            $data = [
                'error' => 'Error al crear el comité: ' . $e->getMessage(),
            ];

            return redirect()->back()->with('error', $data['error'])->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Comite $Comite)
    {
        //return view('admin.comites.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comite $comite)
    {
        return view('admin.comites.edit', [
            'comite' => $comite,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ComiteRequest $request, Comite $comite)
    {

        $url_banner = $comite->imagen_banner;
        // Obtener la URL actual del banner

        // Verificar si se cargó un nuevo banner
        if ($request->hasFile('imagen_banner')) {
            // Si se cargó un nuevo banner, almacenar y obtener su URL
            $url_banner = Storage::put('public/comites/banner', $request->file('imagen_banner'));

            // Eliminar el banner anterior si existe
            if ($comite->imagen_banner) {
                Storage::delete($comite->imagen_banner);
            }
        }

        $data = [
            'nombre' => $request->nombre,
            'slug' => $request->slug,
            'descripcion' => $request->descripcion,
            'imagen_banner' => $url_banner,
        ];

        $comite->update($data);

        // MORPHO IMAGEN // 

        // Verificar si se cargó un nuevo archivo
        if ($request->file('file')) {

            $url = Storage::put('public/comites', $request->file('file'));

            // Si la comite ya tiene una imagen, eliminar el archivo antiguo
            if ($comite->imagen) {
                Storage::delete($comite->imagen->url);

                // Actualizar la relación de imagen con la nueva URL del archivo
                return   $comite->imagen()->update([
                    'url' => $url,
                    'imageable_type' => Comite::class,
                ]);
            } else {
                // Si EL comite no tiene una imagen, agregar una nueva imagen
                $comite->imagen()->create([
                    'url' => $url,
                    'imageable_type' => Comite::class,
                ]);
            }
        }
        // MORPHO IMAGEN // 

        //Elimina la variables almacenada en cache
        Cache::flush();
        //Cache


        // Redireccionar con un mensaje de éxito
        $data = [
            'message' => 'Comité actualizada exitosamente.'
        ];


        return back()->with('success', $data['message']);
    }

    /**
     * Remove the specified resource from storage.
     *       <img src="{{ !empty($serie->imagen->url) ? Storage::url($serie->imagen->url) : 'https://i.ibb.co/YcvYfpx/640x480.png' }}" alt="" />

     */
    public function destroy(Comite $Comite)
    {
        try {
            $Comite->delete();

            //Elimina la variables almacenada en cache
            Cache::flush();
            //Cache

            $data = [
                'message' => 'Comité eliminada exitosamente.',
            ];

            return redirect()->route('admin.comites.index')->with('success', $data['message']);
        } catch (\Exception $e) {
            $data = [
                'message' => 'No se pudo eliminar la Comité, debido a restricción de integridad.',
            ];

            return redirect()->route('admin.comites.index')->with('error', $data['message']);
        }
    }
}
