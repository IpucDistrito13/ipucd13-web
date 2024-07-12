<?php

namespace App\Http\Controllers\Web\Public;

use App\Http\Controllers\Controller;
use App\Models\Comite;
use App\Models\Evento;
use App\Models\Redes;
use Illuminate\Http\Request;

class EventoController extends Controller
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
            'title' => 'Eventos | IPUC Distrito 13',
            'author' => 'IPUC Distrito 13',
            'description' => 'Eventos | IPUC Distrito 13',
        ];

        return view('public.eventos.index', [
            'metaData' => $metaData,
            'comites' => $comitesMenu,

            'transmision' => $transmision,
            'facebook' => $facebookLink,
            'youtube' => $youtubeLink,
            'instagram' => $instagramLink,
        ]);
    }

    public function apiGetEventos()
    {
        $eventos = Evento::select('id', 'title', 'start', 'end', 'backgroundColor', 'borderColor', 'lugar')->get();
        return response()->json($eventos);
    }
}
