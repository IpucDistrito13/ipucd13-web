<?php

namespace App\Http\Controllers\Api\V2;

use App\Http\Controllers\Controller;
use App\Http\Resources\V2\Collection\CongregacionCollection as CollectionCongregacionCollection;
use App\Http\Resources\V2\Resource\CongregacionCollection;
use App\Models\Congregacion;
use Illuminate\Http\Request;

class CongregacionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $congregaciones = Congregacion::where('estado', 'Activo')->get();
        return  new CollectionCongregacionCollection($congregaciones);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
