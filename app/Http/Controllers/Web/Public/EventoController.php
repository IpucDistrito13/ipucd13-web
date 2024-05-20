<?php

namespace App\Http\Controllers\Web\Public;

use App\Http\Controllers\Controller;
use App\Models\Comite;
use Illuminate\Http\Request;

class EventoController extends Controller
{
    public function index()
    {
        $comites = Comite::all();
        $metaData = [
            'titulo' => 'Eventos | IPUC D13',
            'autor' => 'IPUC D13',
            'description' => '',
        ];

        return view('public.eventos.index', compact('metaData', 'comites'));
    }
}
