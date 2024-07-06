<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CarpetaRequest;
use App\Models\Carpeta;
use App\Models\Comite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;


class CarpetaController extends Controller
{
    // LISTA LOS COMITES CON LAS CARPETAS PRIVADAS
    public function listComitePrivado()
    {
        $comites = Comite::select('id', 'nombre', 'slug')->get();
        return view('admin.carpetas.descargable_privado', [
            'comites' => $comites,
        ]);
    }

    // LISTA LOS COMITES CON LAS CARPETAS PUBLICO
    public function listComitePublico()
    {
        $comites = Comite::select('id', 'nombre', 'slug')->get();
        return view('admin.carpetas.descargable_publico', [
            'comites' => $comites,
        ]);
    }

    //SEGUN EL COMITE - LISTAR LAS CARPETAS PRIVADAS
    public function listCarpetasPrivadoComite(Comite $comite)
    {
        $carpetas = Carpeta::where('galeriatipo_id', 2)->where('comite_id', $comite->id)->get();
        return view('admin.carpetas.carpetas_privado', [
            'comite' => $comite,
            'carpetas' => $carpetas,
        ]);
    }

    //SEGUN EL COMITE - LISTAR LAS CARPETAS PUBLICA
    public function listCarpetasPublicoComite(Comite $comite)
    {
        $carpetas = Carpeta::where('galeriatipo_id', 1)->where('comite_id', $comite->id)->get();
        return view('admin.carpetas.carpetas_publico', [
            'comite' => $comite,
            'carpetas' => $carpetas,
        ]);
    }

    // CREAR CARPETA PRIVADO
    public function carpetaPrivado(Comite $comite)
    {
        return view('admin.carpetas.carpetaprivado_create', [
            'comite' => $comite,
        ]);
    }

    public function crearCarpetaPrivada(Comite $comite)
    {
        return view('admin.carpetas.carpetaprivada_create', [
            'comite' => $comite,
        ]);
    }

    public function crearCarpetaPublico(Comite $comite)
    {
        return view('admin.carpetas.carpetapublico_create', [
            'comite' => $comite,
        ]);
    }


    public function storeCarpetaPrivada(CarpetaRequest $request)
    {
        $data = [
            'nombre' => $request->nombre,
            'slug' => $request->slug,
            'descripcion' => $request->descripcion,
            'comite_id' => $request->comite,
            'galeriatipo_id' => 2, //Galeria tipo 2 = privado
        ];

        $carpeta = Carpeta::create($data);

        $data = [
            'message' => 'Carpeta creada exitosamente.',
        ];

        return back()->with('success', $data['message']);
    }

    public function storeCarpetaPublico(Request $request)
    {
        $data = [
            'nombre' => $request->nombre,
            'slug' => $request->slug,
            'descripcion' => $request->descripcion,
            'comite_id' => $request->comite,
            'galeriatipo_id' => 1, //Galeria tipo 1 = publico
        ];

        $carpeta = Carpeta::create($data);

        $data = [
            'message' => 'Carpeta creada exitosamente.',
        ];

        return back()->with('success', $data['message']);
    }

    public function destroyCarpeta($carpetaId)
    {
        try {
            $carpeta = Carpeta::findOrFail($carpetaId);
            $carpeta->delete();

            $data = [
                'message' => 'Carpeta eliminada exitosamente.',
            ];

            //Elimina la variables almacenada en cache
            Cache::flush();
            //Cache

            return back()->with('success', $data['message']);

           // return redirect()->route('admin.podcasts.index')->with('success', $data['message']);
        } catch (\Exception $e) {
            $data = [
                'message' => 'No se pudo eliminar el podcast, debido a restricción de integridad.',
            ];

            //Elimina la variables almacenada en cache
            Cache::flush();
            //Cache

            return back()->with('error', $data['message']);

            //return redirect()->route('admin.podcasts.index')->with('error', $data['message']);
        }
    }
}
