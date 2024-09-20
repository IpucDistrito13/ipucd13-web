<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CronogramaRequest;
use App\Models\Comite;
use App\Models\Cronograma;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;


class CronogramaController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:admin.cronogramas.index')->only(  'index');
        $this->middleware('can:admin.cronogramas.create')->only(  'create', 'store', 'edit', 'update', 'destroy');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.cronogramas.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.cronogramas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CronogramaRequest $request)
    {
        //return $request;
        $cronograma = Cronograma::create($request->all());

        Cache::flush();

        $data = [
            'message' => 'Cronograma creado exitosamente.',
        ];

        return redirect()->route('admin.cronogramas.create')->with('success', $data['message']);

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
    public function destroy(Cronograma $cronograma)
    {
        $cronograma->delete();

        Cache::flush();

        $data = [
            'message' => 'Fecha eliminada exitosamente.',
        ];

    }

    public function apiGetCronogramas()
    {
        $cronogramas = Cronograma::select('id','title', 'start', 'end', 'backgroundColor', 'borderColor','lugar' )->get();
        return response()->json($cronogramas);
    }

    public function cronogramaUsuarios(){
        return view('admin.cronogramas.usuarios');
    }

    
    public function cronogramas()
    {
        $comites = Comite::all();

        $metaData = [
            'title' => 'Cronogramas',
            'author' => 'IPUC D13',
            'description' => 'Cronograma | Distrito 13',
        ];
        return view('publico.cronogramas.index', compact('metaData', 'comites'));
    }
    
}
