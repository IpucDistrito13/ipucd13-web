<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PermisoRequest;
use Encore\Admin\Auth\Database\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;

class PermisoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        /*
        $permisos = \DB::table("permissions")->get();
        return view('admin.permissions.index', [
            'permisos' => $permisos,
        ]);
        */

        $permisos = Permission::all(); // Usa el modelo Eloquent para obtener los permisos
        return view('admin.permissions.index', [
            'permisos' => $permisos,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.permissions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PermisoRequest $request)
    {
        //return $request;
        DB::beginTransaction();

        try {

            $data = Permission::create([
                'name' => $request->name,
                'descripcion' => $request->descripcion,
                'guard_name' => $request->guard_name,

            ]);

            // Elimina datos cache
            Cache::flush();
            DB::commit();

            return redirect()->route('developer.permissions.index')->with('success', $data['message']);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error  store - Permiso: ' . $e->getMessage());

            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Permission $permiso)
    {
        //$permiso;
        return view('admin.permissions.edit', [
            'permiso' => $permiso,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PermisoRequest $request, Permission $permiso)
    {

        //return $request;
    
        DB::beginTransaction();
    
        try {
            // Actualizar los datos del permiso
            $permiso->update([
                'name' => $request->name,
                'descripcion' => $request->descripcion,
                'guard_name' => $request->guard_name,
            ]);
    
            // Limpiar la caché
            Cache::flush();
            DB::commit();
    
            // Redirigir con un mensaje de éxito
            return redirect()->route('developer.permissions.index')->with('success', 'Permiso actualizado exitosamente.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error update - Permiso: ' . $e->getMessage());
    
            // Redirigir con un mensaje de error
            return redirect()->back()->with(['error' => 'No se pudo actualizar el permiso. Por favor, intente de nuevo.']);
        }
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Permission $permiso)
    {
        try {
            // Intenta eliminar el permiso
            $permiso->delete();

            // Limpia la caché
            Cache::flush();

            // Redirige con un mensaje de éxito
            return redirect()->route('developer.permissions.index')->with('success', 'Permiso eliminado exitosamente.');
        } catch (\Exception $e) {
            // Registra el error
            Log::error('Error destroy - Permiso: ' . $e->getMessage());

            // Limpia la caché
            Cache::flush();

            // Redirige con un mensaje de error
            return redirect()->route('developer.permissions.index')->with('error', 'No se pudo eliminar el permiso debido a una restricción de integridad.');
        }
    }
}
