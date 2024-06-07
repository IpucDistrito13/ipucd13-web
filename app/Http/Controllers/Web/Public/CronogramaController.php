<?php

namespace App\Http\Controllers\Web\Public;

use App\Http\Controllers\Controller;
use App\Models\Comite;
use App\Models\Cronograma;
use Illuminate\Http\Request;

class CronogramaController extends Controller
{
    public function index()
    {
        $comitesMenu = Comite::ComiteMenu()->get();
        $metaData = [
            'title' => 'Cronogramas | IPUC D13',
            'author' => 'IPUC D13',
            'description' => 'Distrito 13 | Cronograma',
        ];

        return view('public.eventos.index', [
            'metaData' => $metaData,
            'comites' => $comitesMenu,
        ]);
    }

    public function apiGetCronogramas()
    {
        $cronogramas = Cronograma::select('id', 'title', 'start', 'end', 'backgroundColor', 'borderColor', 'lugar')->get();
        return response()->json($cronogramas);
    }
}
