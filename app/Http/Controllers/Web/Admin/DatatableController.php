<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class DatatableController extends Controller
{
    public function usuarios()
    {
        $cacheKey = 'users_admin';

        // Verificar si los datos están en cache
        if (Cache::has($cacheKey)) {
            $users = Cache::get($cacheKey);
            //return 'Guardado';
        } else {
            $users = User::with(['roles', 'congregacion'])->get();
            Cache::put($cacheKey, $users);
            //return 'No Guardado';

        }

        return datatables()::of($users)
            ->addColumn('action', function ($user) {
                $editUrl = route('admin.usuarios.edit', $user);
                $deleteUrl = route('admin.usuarios.destroy', $user);

                $buttons = '<a href="' . $editUrl . '" class="edit btn btn-primary btn-sm">Editar</a>';

                // Agregar botón de eliminación con alerta de confirmación
                $buttons .= '<form id="deleteForm_' . $user->id . '" action="' . $deleteUrl . '" method="POST" class="d-inline">';
                $buttons .= csrf_field(); // Agregar token CSRF
                $buttons .= '<input type="hidden" name="_method" value="DELETE">';
                $buttons .= '<button type="button" onclick="confirmDelete(' . $user->id . ', \'' . $user->nombre . '\', \'' . $user->apellido . '\')" class="delete btn btn-danger btn-sm">Eliminar</button>';
                $buttons .= '</form>';
                return $buttons;
            })
            ->addColumn('role', function ($user) {
                return $user->roles->pluck('name')->implode(', ');
            })
            ->addColumn('direccion_congregacion', function ($user) {
                return $user->congregacion->direccion;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function galeriaTodos()
    {
        $cacheKey = 'galeria_admin';

        // Verificar si los datos están en cache
        if (Cache::has($cacheKey)) {
            $users = Cache::get($cacheKey);
            //return 'Guardado';
        } else {
            $users = User::with(['roles', 'congregacion'])->get();
            Cache::put($cacheKey, $users);
            //return 'No Guardado';

        }

        return datatables()::of($users)
            ->addColumn('action', function ($user) {
                $privado = route('admin.galerias.privadoadmin', $user);
                $general = route('admin.galerias.generaladmin', $user);

                $buttons = '<div class="btn-group" role="group">';
                $buttons .= '<a href="' . $privado . '" class="edit btn btn-danger btn-sm">Galeria privada</a>';
                $buttons .= ' <a href="' . $general . '" class="edit btn btn-success btn-sm">Galeria general</a>';
                $buttons .= '</div>';

                return $buttons;
            })
            ->addColumn('role', function ($user) {
                return $user->roles->pluck('name')->implode(', ');
            })
            ->addColumn('direccion_congregacion', function ($user) {
                return $user->congregacion->direccion;
            })
            ->rawColumns(['action'])
            ->make(true);
    }



    public function usuarios2()
    {
        $users = User::with(['roles', 'congregacion'])->get();

        return datatables()::of($users)
            ->addColumn('action', function ($user) {
                $editUrl = route('admin.usuarios.edit', $user);
                $deleteUrl = route('admin.usuarios.destroy', $user);

                $buttons = '<a href="' . $editUrl . '" class="edit btn btn-primary btn-sm">Editar</a>';

                // Agregar botón de eliminación con alerta de confirmación
                $buttons .= '<form id="deleteForm_' . $user->id . '" action="' . $deleteUrl . '" method="POST" class="d-inline">';
                $buttons .= csrf_field(); // Agregar token CSRF
                $buttons .= '<input type="hidden" name="_method" value="DELETE">';
                $buttons .= '<button type="button" onclick="confirmDelete(' . $user->id . ', \'' . $user->nombre . '\', \'' . $user->apellido . '\')" class="delete btn btn-danger btn-sm">Eliminar</button>';
                $buttons .= '</form>';
                return $buttons;
            })
            ->addColumn('role', function ($user) {
                return $user->roles->pluck('name')->implode(', ');
            })
            ->addColumn('direccion_congregacion', function ($user) {
                return $user->congregacion->direccion;
            })
            ->rawColumns(['action'])
            ->make(true);
    }
}
