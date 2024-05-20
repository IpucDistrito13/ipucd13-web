<?php

namespace App\Http\Controllers\Web\Public;

use App\Http\Controllers\Controller;
use App\Models\Categoria;
use App\Models\Comite;
use App\Models\Publicacion;
use App\Models\Redes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class PublicacionController extends Controller
{
    public function index()
    {
        $comites = Comite::all();

        //PAGINACION POR CACHE
        if (request()->page) {
            $key = 'publicaciones' . request()->page;
        } else {
            $key = 'publicaciones';
        }

        if (Cache::has('publicaciones')) {
            $publicaciones = Cache::get('publicaciones');
        } else {
            $publicaciones = Publicacion::where('estado', 'Publicado')
                ->latest('id')
                ->paginate(8);
            Cache::put($key, $publicaciones);
        }
        //PAGINACION POR CACHE

        /*$publicaciones = Publicacion::where('estado', 'Publicado')
            ->latest('id')
            ->paginate(8);
            */

        $metaData = [
            'title' => 'Publicaciones | IPUC D13',
            'author' => 'IPUC D13',
            'description' => '',
        ];

        return view('public.publicaciones.index', [
            'comites' => $comites,
            'publicaciones' => $publicaciones,
            'metaData' => $metaData,
        ]);
    }

    public function show(Publicacion $publicacion)
    {
        $categorias = Categoria::all();
        //$etiquetas = Etiqueta::all();
        $comites = Comite::all();
        $redes_sociales = Redes::where('estado', 'Activo')->get();
        $similares = Publicacion::select('id', 'titulo', 'slug', 'descripcion', 'comite_id', 'user_id', 'created_at')->where('categoria_id', $publicacion->categoria_id)
            ->where('estado', 'Publicado')
            ->latest('id')
            ->take(3)
            ->get();

            $metaData = [
                'title' => 'Publicaciones | IPUC D13',
                'author' => 'IPUC D13',
                'description' => '',
            ];

        return view('public.publicaciones.show', [
            'publicacion' => $publicacion,
            'similares' => $similares,
            'comites' => $comites,
            'redes_sociales' => $redes_sociales,
            //'etiquetas' => $etiquetas,
            'categorias' => $categorias,
            'metaData' => $metaData,
        ]);
    }
}
