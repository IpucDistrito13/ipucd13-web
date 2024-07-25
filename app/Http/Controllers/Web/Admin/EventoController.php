<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\EventoRequest;
use App\Http\Resources\EventoMensualResource;
use App\Http\Resources\V1\EventoResource;
use App\Models\Comite;
use App\Models\Evento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class EventoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.eventos.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.eventos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EventoRequest $request)
    {
        $evento = Evento::create($request->all());

        Cache::flush();
        $data = [
            'message' => 'Evento creado exitosamente.',
        ];

        return redirect()->route('admin.eventos.create')
            ->with('success', $data['message']);
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
    public function destroy(Evento $evento)
    {
        $evento->delete();
        Cache::flush();

        $data = [
            'message' => 'Evento eliminado exitosamente.',
        ];
    }

    public function apiGetEventos()
    {
        $eventos = Evento::select('id', 'title', 'start', 'end', 'backgroundColor', 'borderColor', 'lugar')->get();
        return response()->json($eventos);
    }

    public function apiGetEventos2()
    {
        $eventos = Evento::all();
        return EventoMensualResource::collection($eventos);
    }

    public function eventos()
    {
        $comites = Comite::all();

        return view('publico.eventos.index', compact('comites'));
    }

    //MOSTRAR PARA LOS USUARIOS LOGUEADOS SEGUN EL ROL
    public function showusuarios()
    {
        return view('admin.eventos.users');
    }
}
