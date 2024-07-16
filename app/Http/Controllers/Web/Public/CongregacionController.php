<?php

namespace App\Http\Controllers\Web\Public;

use App\Http\Controllers\Controller;
use App\Models\Comite;
use App\Models\Congregacion;
use App\Models\Redes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class CongregacionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //return Congregacion::all();
        $metaData = [
            'title' => 'Congregaciones | IPUC Distrito 13',
            'autor' => 'IPUC Distrito 13',
            'description' => 'Congregaciones | IPUC Distrito 13',
        ];

        $comitesMenu = Comite::ComiteMenu()->get();
        //REDES
        $redes_sociales = Redes::Activo()->get();
        $facebookLink = '';
        $youtubeLink = '';
        $instagramLink = '';
        $transmision = Redes::GetTransmision()->first();

        // Itera sobre la lista para encontrar Facebook
        foreach ($redes_sociales as $redSocial) {
            switch ($redSocial["nombre"]) {
                case "Facebook":
                    $facebookLink = $redSocial["url"];
                    break;
                case "YouTube":
                    $youtubeLink = $redSocial["url"];
                    break;
                case "Instagram":
                    $instagramLink = $redSocial["url"];
                    break;
            }
        }
        // REDES


        //CACHE
        if (Cache::has('public.congregaciones')) {
            $congregaciones = Cache::get('public.congregaciones');
        } else {
            $congregaciones = Congregacion::all();
            Cache::put('public.congregaciones', $congregaciones);
        }

        //CACHE
        return view('public.congregaciones.index', [
            'congregaciones' => $congregaciones,
            'comites' => $comitesMenu,
            'metaData' => $metaData,

            'transmision' => $transmision,
            'facebook' => $facebookLink,
            'youtube' => $youtubeLink,
            'instagram' => $instagramLink,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
