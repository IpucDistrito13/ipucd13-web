<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LiderTipoRequest;
use App\Models\Comite;
use App\Models\LiderTipo;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class LiderTipoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->middleware('can:admin.lideres_tipos.index')->only(  'index');
        $this->middleware('can:admin.lideres_tipos.create')->only(  'create', 'store', 'edit', 'destroy');
    }

    public function index()
    {
        $tipos = LiderTipo::selectList()->get();
        return view('admin.lidertipos.index', [
            'tipos' => $tipos,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.lidertipos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LiderTipoRequest $request)
    {
        // Utilizamos DB::transaction() para iniciar una transacción en la base de datos
        DB::beginTransaction();

        try {
            $data = [
                'nombre' => $request->nombre,
                'slug' => $request->slug,
                'descripcion' => $request->descripcion,
            ];

            // Creamos el registro dentro de la transacción
            LiderTipo::create($data);

            // Commit para confirmar la transacción si todo va bien
            DB::commit();

            return redirect()->route('admin.lideres_tipos.index')
                ->with('success', 'Comité creado exitosamente.');
        } catch (\Exception $e) {
            // En caso de error, hacemos rollback para revertir cualquier cambio en la base de datos
            DB::rollback();
            Log::error('Error  store - LiderTipo: ' . $e->getMessage());

            // Aquí puedes manejar el error como desees, por ejemplo, redireccionar con un mensaje de error
            return redirect()
                ->back()
                ->withInput()
                ->with(['error' => 'Ha ocurrido un error al crear el tipo de líder. 
                Por favor, intenta de nuevo más tarde.']);
        }
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
    public function edit(LiderTipo $lideres_tipo)
    {
        //
        //return 'edit';
        return view('admin.lidertipos.edit', [
            'tipo' => $lideres_tipo,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(LiderTipoRequest $request, LiderTipo $lideres_tipo)
    {

        DB::beginTransaction();

        try {
            $data = [
                'nombre' => $request->nombre,
                'slug' => $request->slug,
                'descripcion' => $request->descripcion,
            ];

            // Actualizamos el registro dentro de la transacción
            $lideres_tipo->update($data);

            // Commit para confirmar la transacción si todo va bien
            DB::commit();

            return redirect()->route('admin.lideres_tipos.index')->with('success', 'Tipo de líder actualizado exitosamente.');
        } catch (\Exception $e) {
            // En caso de error, hacemos rollback para revertir cualquier cambio en la base de datos
            DB::rollback();
            Log::error('Error  update - LiderTipo: ' . $e->getMessage());


            // Aquí puedes manejar el error como desees, por ejemplo, redireccionar con un mensaje de error
            return redirect()->back()->withInput()->with(['error' => 'Ha ocurrido un error al actualizar el tipo de líder. Por favor, intenta de nuevo más tarde.']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LiderTipo $lideres_tipo)
    {

        DB::beginTransaction();

        try {
            // Eliminamos el registro dentro de la transacción
            $lideres_tipo->delete();

            // Commit para confirmar la transacción si todo va bien
            DB::commit();

            return redirect()->route('admin.lideres_tipos.index')->with('success', 'Tipo de líder eliminado exitosamente.');
        } catch (\Exception $e) {
            // En caso de error, hacemos rollback para revertir cualquier cambio en la base de datos
            DB::rollback();
            Log::error('Error  delete - LiderTipo: ' . $e->getMessage());

            // Aquí puedes manejar el error como desees, por ejemplo, redireccionar con un mensaje de error
            return redirect()->back()->withInput()->with(['error' => 'Ha ocurrido un error al eliminar el tipo de líder. Por favor']);
        }
    }
}
