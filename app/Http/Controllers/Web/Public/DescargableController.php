<?php

namespace App\Http\Controllers\Web\Public;

use App\Http\Controllers\Controller;
use App\Models\Comite;
use Illuminate\Http\Request;

class DescargableController extends Controller
{
    public function index()
    {
        $comites = Comite::all();
        $metaData = [
            'titulo' => 'Descargable | IPUC D13',
            'autor' => 'IPUC D13',
            'description' => '',
        ];

        return view('public.descargables.index', compact('comites', 'metaData'));
    }
}
