<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Models\GenerarKeyApi;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class GenerarApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $apis = GenerarKeyApi::all();
        return view('admin.apis.index', [
            'apis' => $apis,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // $apiKey =  Str::random(32); // Genera una cadena aleatoria de 32 caracteres
        return view('admin.apis.create', [
            //'apiKey' => $apiKey
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $apiKey =  Str::random(32);
        $data = [
            'apikey' => $apiKey,
            'descripcion' => $request->descripcion,
            'tipo' => $request->tipo
        ];

        GenerarKeyApi::create($data);
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
