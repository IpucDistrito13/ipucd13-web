<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Models\Redes;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $transmision = Redes::GetTransmision()->first();

        return view('admin.home.index',[
            'transmision' => $transmision,
        ]);
    }

    
}
