<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\UsuariosResource;
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

    public function galeriaTodos3()
    {
        $users = User::with(['roles:name', 'congregacion:id,direccion'])->get();

        $data = UsuariosResource::collection($users);

        return response()->json([
            'draw' => 1, // Número de solicitud de dibujo
            'recordsTotal' => $users->count(), // Total de registros antes de filtrado
            'recordsFiltered' => $users->count(), // Total de registros después del filtrado
            'data' => $data, // Datos a mostrar
        ]);
    }

    public function galeriaTodos()
    {


        $users = User::with(['roles:name', 'congregacion:id,direccion'])->get();

        $data = $users->map(function ($user) {
            $privado = route('admin.galerias.privadoadmin', $user);
            $general = route('admin.galerias.generaladmin', $user);

            return [
                'id' => $user->id,
                'codigo' => $user->codigo,
                'nombre' => $user->nombre,
                'apellidos' => $user->apellidos,
                'celular' => $user->celular,
                'email' => $user->email,
                'role' => $user->roles->pluck('name')->implode(', '),
                'direccion_congregacion' => $user->congregacion->direccion,
                'action' => '<div class="btn-group" role="group">' .
                    '<a href="' . $privado . '" class="edit btn btn-danger btn-sm">Galeria privada</a>' .
                    ' <a href="' . $general . '" class="edit btn btn-success btn-sm">Galeria general</a>' .
                    '</div>',
            ];
        });

        return response()->json([
            'draw' => 1, // Número de solicitud de dibujo
            'recordsTotal' => $users->count(), // Total de registros antes de filtrado
            'recordsFiltered' => $users->count(), // Total de registros después del filtrado
            'data' => $data, // Datos a mostrar
        ]);
    }


    public function galeriaTodos2()
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

    public function listJson(Request $request)
    {

        // Page Length
        $pageNumber = ($request->start / $request->length) + 1;
        $pageLength = $request->length;
        $skip       = ($pageNumber - 1) * $pageLength;

        // Page Order
        $orderColumnIndex = $request->order[0]['column'] ?? '0';
        $orderBy = $request->order[0]['dir'] ?? 'desc';

        $orderByName = "name";

        switch ($orderColumnIndex) {
            case "0":
                $orderByName = "nombre";
                break;
            case "1":
                $orderByName = "apellidos";
                break;
            case "2":
                $orderByName = "celular";
                break;

            case "3":
                $orderByName = "uuid";
                break;
        }
        $query = \DB::table("users")
            ->select('id', 'nombre', 'apellidos', 'celular', 'uuid'); // Select specific columns

        // Search
        // $search = $request->search["value"];
        $search = $request->cSearch;
        if (!empty($search)) {
            $query = $query->where(function ($query) use ($search) {
                $query->orWhere('nombre', 'like', "%" . $search . "%");
                $query->orWhere('apellidos', 'like', "%" . $search . "%");
                $query->orWhere('celular', 'like', "%" . $search . "%");
            });
        }

        $query = $query->orderBy($orderByName, $orderBy);
        $recordsTotal = $recordsFiltered = $query->count();

        $users = $query->take($pageLength)->skip($skip)->get();

        return response()->json([
            'draw' => $request->draw,
            'recordsTotal' => $recordsTotal,
            'recordsFiltered' => $recordsFiltered,
            'data' => $users
        ], 200);
    }
}
