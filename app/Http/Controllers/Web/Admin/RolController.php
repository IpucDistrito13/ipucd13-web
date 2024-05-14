<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //CACHE
        if (Cache::has('roles')) {
            $roles = Cache::get('roles');
        } else {
            $roles = Role::all();
            Cache::put('roles', $roles);
        }
        //CACHE

        //$roles = Role::all();
        return view('admin.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permisos = Permission::all();
        return view('admin.roles.create', compact('permisos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'isbloqued' => 'No',
        ]);

        $data = [
            'name' => $request->name,
            'guard_name' => 'web',
        ];

        $role = Role::create($data);

        // Sincronizar los permisos asociados al rol
        $role->permissions()->sync($request->permissions);

        //Elimina datos cache
        Cache::flush();
        //Cache

        return redirect()->route('admin.roles.edit', $role)->with('success', 'Rol creado exitosamente.');
    }


    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        return view('admin.roles.show', compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        $permisos = Permission::all();
        return view('admin.roles.edit', compact('role', 'permisos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $data = [
            'name' => $request->name,
            'guard_name' => 'web',
        ];

        // Utiliza el método update en la instancia específica del modelo Role
        $role->update($data);

        // Sincronizar los permisos asociados al rol
        $role->permissions()->sync($request->permissions);

        //Elimina datos cache
        Cache::flush();
        //Cache

        return redirect()->route('admin.roles.edit', $role)->with('success', 'Rol actualizado exitosamente.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        $role->delete();
        $data = [
            'message' => 'Rol eliminado exitosamente.',
        ];

        //Elimina datos cache
        Cache::flush();
        //Cache

        return redirect()->route('admin.roles.index')->with('success', $data['message']);
    }
}
