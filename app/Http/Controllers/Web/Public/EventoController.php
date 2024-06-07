<?php

namespace App\Http\Controllers\Web\Public;

use App\Http\Controllers\Controller;
use App\Models\Comite;
use App\Models\Evento;
use Illuminate\Http\Request;

class EventoController extends Controller
{
    public function index()
    {
        $comitesMenu = Comite::ComiteMenu()->get();
        $metaData = [
            'title' => 'Eventos | IPUC D13',
            'author' => 'IPUC D13',
            'description' => '',
        ];

        return view('public.eventos.index', [
            'metaData' => $metaData,
            'comites' => $comitesMenu,
        ]);
    }

    public function apiGetEventos()
    {
        $eventos = Evento::select('id', 'title', 'start', 'end', 'backgroundColor', 'borderColor', 'lugar')->get();
        return response()->json($eventos);
    }
}
