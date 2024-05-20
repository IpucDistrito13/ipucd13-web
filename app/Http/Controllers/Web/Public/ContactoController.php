<?php

namespace App\Http\Controllers\Web\Public;

use App\Http\Controllers\Controller;
use App\Models\Comite;
use Illuminate\Http\Request;

class ContactoController extends Controller
{
    public function index()
    {
        $metaData = [
            'titulo' => 'Contacto | IPUC D13',
            'autor' => 'IPUC D13',
            'description' => '',
        ];

        $comites = Comite::all();
        return view('public.contacto.index', compact('comites', 'metaData'));
    }
}
