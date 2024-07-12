<?php

namespace App\Http\Controllers\Web\Public;

use App\Http\Controllers\Controller;
use App\Models\Comite;
use App\Models\Cronograma;
use App\Models\Redes;
use Illuminate\Http\Request;

class CronogramaController extends Controller
{
    public function index()
    {
        $comitesMenu = Comite::ComiteMenu()->get();

        //REDES
        $redes_sociales = Redes::Activo()->get();
        $facebookLink = '';
        $youtubeLink = '';
        $instagramLink = '';
        $transmision = Redes::GetTransmision()->first();

        $metaData = [
            'title' => 'Cronogramas | IPUC Distrito 13',
            'author' => 'IPUC D13',
            'description' => 'Cronogramas | IPUC Distrito 13',
        ];

        return view('public.cronogramas.index', [
            'metaData' => $metaData,
            'comites' => $comitesMenu,

            'transmision' => $transmision,
            'facebook' => $facebookLink,
            'youtube' => $youtubeLink,
            'instagram' => $instagramLink,
        ]);
    }

    public function apiGetCronogramas()
    {
        $cronogramas = Cronograma::select('id', 'title', 'start', 'end', 'backgroundColor', 'borderColor', 'lugar')->get();
        return response()->json($cronogramas);
    }
}
