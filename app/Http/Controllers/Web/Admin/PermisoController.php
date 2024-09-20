<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PermisoRequest;
use App\Models\Permiso;
use Encore\Admin\Auth\Database\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;
use Spatie\Permission\Models\Role;



class PermisoController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:developer.permissions.index')->only(  'index');
        $this->middleware('can:developer.permissions.create')->only(  'create', 'store', 'edit', 'update', 'destroy');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
{
    $permisos = DB::table('permissions as p')
        ->join('role_has_permissions as rp', 'p.id', '=', 'rp.permission_id')
        ->join('roles as r', 'r.id', '=', 'rp.role_id')
        ->select(
            'p.id',
            'p.name',
            'p.descripcion',
            'p.guard_name',
            'p.updated_at',
            DB::raw('GROUP_CONCAT(r.name ORDER BY r.name SEPARATOR ", ") as role_names')
        )
        ->groupBy('p.id', 'p.name', 'p.descripcion')
        ->orderBy('p.created_at', 'desc')
        ->get();

    return view('admin.permissions.index', [
        'permisos' => $permisos,
    ]);
}


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();
        return view('admin.permissions.create', [
            'roles' => $roles,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PermisoRequest $request)
    {
        //return $request;   
        DB::beginTransaction();

        try {
            // Crea el nuevo permiso
            $permission = Permiso::create([
                'name' => $request->name,
                'descripcion' => $request->descripcion,
                'guard_name' => 'web',
            ]);


            // Obtén los IDs de roles seleccionados
            $roleIds = $request->input('roles', []);

            // Asigna el permiso a los roles seleccionados
            foreach ($roleIds as $roleId) {
                DB::table('role_has_permissions')->insert([
                    'permission_id' => $permission->id,
                    'role_id' => $roleId,
                ]);
            }

            // Elimina datos de cache
            Cache::flush();
            DB::commit();

            return redirect()->route('developer.permissions.index')->with('success', 'Permiso creado y asignado exitosamente.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error en store - Permiso: ' . $e->getMessage());

            return redirect()->back()->with(['error' => $e->getMessage()]);
        }

    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Permission $permission)
    {
        //$permiso;
        return view('admin.permissions.edit', [
            'permiso' => $permission,
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


/*

CREATE VIEW permisos_con_roles AS
SELECT 
    p.id,
    p.name,
    p.descripcion,
    p.guard_name,
    GROUP_CONCAT(r.name ORDER BY r.name SEPARATOR ', ') AS role_names
FROM 
    permissions p
JOIN 
    role_has_permissions rp ON p.id = rp.permission_id
JOIN 
    roles r ON r.id = rp.role_id
GROUP BY 
    p.id, p.name, p.descripcion, p.guard_name;

    */