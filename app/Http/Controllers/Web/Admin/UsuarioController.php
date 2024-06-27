<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UsuarioRequest;
use App\Mail\NuevoUsuarioMail;
use App\Models\Congregacion;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Mail;


class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    protected static ?string $password;

    public function index(Request $request)
    {
        return view('admin.usuarios.index');
    }

    public function serverSideJson(Request $request)
    {
        if ($request->ajax()) {
            $data = \DB::table("vista_roles_usuario")->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $editUrl = route('admin.usuarios.editar', $row->id);

                    $btn = '<a href="' . $editUrl . '" class="edit btn btn-primary btn-sm">Editar</a>';
                    $btn .= '<form id="deleteForm_' . $row->id . '" action="' . $editUrl . '" method="POST" class="d-inline">';
                    $btn .= csrf_field(); // Agregar token CSRF
                    $btn .= '<input type="hidden" name="_method" value="DELETE">';
                    $btn .= '<button type="button" onclick="confirmDelete(' . $row->id . ', \'' . $row->nombre . '\', \'' . $row->apellidos . '\')" class="delete btn btn-danger btn-sm">Eliminar</button>';
                    $btn .= '</form>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    /*
    public function index2(Request $request)
    {
        if ($request->ajax()) {
            //$rolId = 2;
            $data = DB::table('vista_roles_usuario')->get();

            return datatables()::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $buttons = '<a href="' . route("admin.galerias.privadoadmin", $row->uuid) . '" class="btn btn-primary btn-sm">Galería Privada</a>';
                    $buttons .= ' <a href="' . route("admin.galerias.generalAdmin", $row->uuid) . '" class="btn btn-secondary btn-sm">Galería General</a>';
                    return $buttons;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.usuarios.index');
    }
    */

    //LISTAR SOLO LOS LIDERES DESDE EL DIRECTORIO D13
    public function directorioLideres(Request $request)
    {
        //$rolId = 3;
        $rol = 'Lider';
        if ($request->ajax()) {
            $data = User::VistaRolUsers($rol)->get();

            return datatables()::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $buttons = ' <a href="' . route("admin.galerias.generalLider", $row->uuid) . '" class="btn btn-primary btn-sm">LLamar</a>';
                    return $buttons;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.directorio.lideres');
    }

    //LISTAR SOLO LOS PASTORES DESDE EL DIRECTORIO D13
    public function directorioPastores(Request $request)
    {
        //$rolId = 2;
        $rol = 'Pastor';
    
        if ($request->ajax()) {
            $data = User::VistaRolUsers($rol)->get();
    
            return datatables()::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $buttons = ' <a href="' . route("admin.galerias.generalLider", $row->uuid) . '" class="btn btn-secondary btn-sm">Ver galeria</a>';
                    $buttons .= ' <a href="tel:' . $row->celular . '" class="btn btn-primary btn-sm">Llamar</a>';
                    return $buttons;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    
        return view('admin.directorio.pastores');
    }
    
    public function directorio()
    {
        //$usuarios = User::select('nombre', 'apellidos', 'celular', 'visible_celular')->paginate(30);
        $usuarios = User::select('id', 'nombre', 'apellidos', 'celular', 'visible_celular', 'congregacion_id')
            ->with(['roles:id,name', 'congregacion:id,municipio_id,direccion'])
            ->orderBy('nombre')
            ->paginate(39);

        // Transformar la colección para incluir los nombres de los roles
        $usuarios->getCollection()->transform(function ($user) {
            $user->role_names = $user->roles->pluck('name'); // Agrega los nombres de los roles al usuario
            return $user;
        });

        return view('admin.directorio.index', compact('usuarios'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();
        $congregaciones = Congregacion::select('id', 'direccion')->where('estado', 'Activo')->get();
        return view('admin.usuarios.create', compact('congregaciones', 'roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UsuarioRequest $request)
    {
        //  return $request;
        $url = '';
        if ($request->file('file')) {
            $url = Storage::put('public/usuarios', $request->file('file'));
        }

        $codigo = in_array(2, $request->roles) ? $request->codigo : '';

        $timeAndPassword = time();
        $hashedPassword = Hash::make($timeAndPassword);

        $usuario = User::create([
            'name' => $request->nombre,
            'congregacion_id' => $request->congregacion,

            'uuid' => $timeAndPassword,
            'codigo' => $codigo,
            'nombre' => $request->nombre,
            'apellidos' => $request->apellidos,
            'celular' => $request->celular,
            'visible_celular' => 1,
            'email' => $request->email,
            'profile_photo_path' => $url,
            'password' => $hashedPassword,
        ]);

        $usuario->roles()->sync($request->roles);

        $usuario->imagen()->create([
            'url' => $url,
            'imageable_type' => User::class,
        ]);

        $data = [
            'message' => 'Usuario creado exitosamente.',
        ];

        //Elimina datos cache
        Cache::flush();
        //Cache

        Mail::to($usuario->email)->send(new NuevoUsuarioMail($usuario));


        return redirect()->route('admin.usuarios.index')->with('success', $data['message']);
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
    public function edit(User $usuario)
    {
        $roles = Role::all();
        //return $usuario;

        $congregaciones = Congregacion::SelectList()->get();
        return view('admin.usuarios.edit', [
            'usuario' => $usuario,
            'congregaciones' => $congregaciones,
            'roles' => $roles,
        ]);
    }

    public function editar($usuarioId)
    {
        $usuario = User::find($usuarioId);
        $congregaciones = Congregacion::SelectList()->get();
        $roles = Role::all();

        if ($usuario) {
            //return $usuario;
            return view('admin.usuarios.edit', [
                'usuario' => $usuario,
                'congregaciones' => $congregaciones,
                'roles' => $roles,
            ]);
        } else {
            return 'Usuario no existe';
        }
    }

    public function updatePerfil(Request $request, User $usuario)
    {
        $request->validate([
            'email' => [
                'sometimes',
                'email',
                Rule::unique('users')->ignore($usuario->id),
            ],
            'password' => 'nullable|string|min:8|confirmed',
            // usar confirmed en lugar de password_confirmation
        ]);

        // Preparar los datos para la actualización
        $data = [
            'email' => $request->email,
        ];

        // Validar y actualizar el correo electrónico si se proporciona
        if ($request->has('email')) {
            $data['email'] = $request->input('email');
        }

        // Validar y actualizar la contraseña si se proporciona
        if ($request->filled('password')) {
            $data['password'] = bcrypt($request->input('password'));
        }

        // Manejar la imagen de perfil si se proporciona
        if ($request->file('file')) {
            //$url = Storage::disk('s3')->put('public/usuarios/perfil', $request->file('file'));
            $ubicacion = 'public/usuarios/perfil';
            if (env('APP_ENV') === 'local') {
                $url = Storage::put($ubicacion, $request->file('file'));
            } else {
                $url = Storage::disk('s3')->put($ubicacion, $request->file('file'));
            }
            
            // Si el usuario ya tiene una imagen, eliminar el archivo antiguo y actualizar la URL
            if ($usuario->imagen) {
                Storage::delete($usuario->imagen->url);
                $usuario->imagen()->update([
                    'url' => $url,
                    'imageable_type' => User::class,
                ]);
            } else {
                // Si el usuario no tiene una imagen, agregar una nueva imagen
                $usuario->imagen()->create([
                    'url' => $url,
                    'imageable_type' => User::class,
                ]);
            }
        }

        // Actualizar el usuario con los datos preparados
        $usuario->update($data);
        Cache::flush();

        // Redirigir con un mensaje de éxito
        return redirect()->route('admin.usuario.perfil')->with('success', 'Perfil actualizado exitosamente.');
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UsuarioRequest $request, User $usuario)
    {
        $usuario->roles()->sync($request->roles);
        $data = [
            'name' => $request->nombre,
            'congregacion_id' => $request->congregacion,
            'codigo' => $request->codigo,
            'nombre' => $request->nombre,
            'apellidos' => $request->apellidos,
            'celular' => $request->celular,
            'email' => $request->email,
            'profile_photo_path' => $request->file,
        ];

        $usuario->update($data);

        if ($request->file('file')) {
            $url = Storage::put('public/usuarios/perfil', $request->file('file'));

            // Si el usuario ya tiene una imagen, eliminar el archivo antiguo y actualizar la URL
            if ($usuario->imagen) {
                Storage::delete($usuario->imagen->url);
                $usuario->imagen()->update([
                    'url' => $url,
                    'imageable_type' => User::class,
                ]);
            } else {
                // Si el usuario no tiene una imagen, agregar una nueva imagen
                $usuario->imagen()->create([
                    'url' => $url,
                    'imageable_type' => User::class,
                ]);
            }
        }

        Cache::flush();

        $message = 'Usuario actualizada exitosamente.';
        return redirect()->route('admin.usuarios.edit', $usuario)->with('success', $message);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $usuario)
    {
        try {
            $usuario->delete();

            $data = [
                $message = 'Usuario eliminado exitosamente.',

            ];
            Cache::flush();

            return redirect()->route('admin.usuarios.index')->with('success', $data['message']);
        } catch (\Exception $e) {

            \Log::error('Error al eliminar usuario: ' . $e->getMessage());

            $data = [
                $message = 'No se pudo eliminar el usuario, debido a restricción de integridad.',
            ];

            return redirect()->route('admin.usuarios.index')->with('error', $data['message']);
        }
    }


    public function perfil()
    {
        $usuario = auth()->user();
        return view('admin.usuarios.perfil', compact('usuario'));
    }

    public function api()
    {
        $users = User::with(['roles', 'congregacion'])->get();

        return DataTables::of($users)
            ->addColumn('action', function ($user) {
                $editUrl = route('admin.usuarios.edit', $user);

                $buttons = '<a href="' . $editUrl . '" class="edit btn btn-primary btn-sm">Editar</a>';

                // Agregar botón de eliminación con alerta de confirmación        
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
