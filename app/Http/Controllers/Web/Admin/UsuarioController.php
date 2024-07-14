<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UsuarioRequest;
use App\Mail\NuevoUsuarioMail;
use App\Models\Comite;
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
use Illuminate\Support\Facades\DB;

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
                    $deleteUrl = route('admin.usuarios.destroyUser', $row->id);

                    $btn = '<a href="' . $editUrl . '" class="edit btn btn-primary btn-sm">Editar</a>';
                    $btn .= '<form id="deleteForm_' . $row->id . '" action="' . $deleteUrl . '" method="POST" class="d-inline">';
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
        $congregaciones = Congregacion::select('id', 'direccion', 'nombre')->where('estado', 'Activo')->get();
        return view('admin.usuarios.create', compact('congregaciones', 'roles'));
    }

    private function storeFile($file, $ubicacion)
    {
        if (env('APP_ENV') === 'local') {
            return Storage::put($ubicacion, $file);
        } else {
            return Storage::disk('s3')->put($ubicacion, $file);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UsuarioRequest $request)
    {
        DB::beginTransaction();

        try {
            $url = '';
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
                'created_by' => auth()->id(),
            ]);

            if ($request->hasFile('file')) {
                $imgPerfil = $request->file('file');
                $ubicacionImgPerfil = 'public/usuarios/' . $usuario->uuid . '/' . 'perfil';
                $url = $this->storeFile($imgPerfil, $ubicacionImgPerfil);

                // Si el usuario no tiene una imagen, agregar una nueva imagen
                $usuario->imagen()->create([
                    'url' => $url,
                    'imageable_type' => User::class,
                ]);
            }

            $usuario->roles()->sync($request->roles);

            $data = [
                'message' => 'Usuario creado exitosamente.',
            ];

            // Elimina datos cache
            Cache::flush();

            // Enviar correo
            Mail::to($usuario->email)->send(new NuevoUsuarioMail($usuario));

            DB::commit();

            return redirect()->route('admin.usuarios.index')->with('success', $data['message']);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error  store - Usuario: ' . $e->getMessage());

            return redirect()->back()->with(['error' => 'Ocurrió un error al crear el usuario.']);
        }
    }


    public function storeCongregacionPastor()
    {

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
            'celular' => 'required|regex:/^[0-9]{10}$/',
            // usar confirmed en lugar de password_confirmation
        ]);

        // Preparar los datos para la actualización
        $data = [
            'email' => $request->email,
            'celular' => $request->celular,
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
            $imgPerfil = $request->file('file');
            $ubicacionImgPerfil = 'public/usuarios/' . $usuario->uuid . '/' . 'perfil';
            $url = $this->storeFile($imgPerfil, $ubicacionImgPerfil);

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
            'estado' => $request->estado,
        ];

        $usuario->update($data);

        if ($request->file('file')) {
            $imgPerfil = $request->file('file');
            $ubicacionImgPerfil = 'public/usuarios/' . $usuario->uuid . '/' . 'perfil';
            $url = $this->storeFile($imgPerfil, $ubicacionImgPerfil);

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

    private function deleteFile($url)
    {
        // Lógica para eliminar el archivo físico dependiendo del entorno
        if (env('APP_ENV') === 'local') {
            Storage::delete($url); // Eliminar archivo localmente
        } else {
            // Lógica para eliminar el archivo en S3 u otro servicio de almacenamiento en la nube
            Storage::disk('s3')->delete($url);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroyUser($id)
    {
        $usuario = User::findOrFail($id);

        try {
            $usuario->delete();

            $data = [
                $message = 'Usuario eliminado exitosamente.',

            ];

            // Eliminar todas las imágenes de portada asociadas al comité, si las hay
            if ($usuario->imagen()->exists()) {
                foreach ($usuario->imagen()->get() as $imagen) {
                    $this->deleteFile($imagen->url);
                    $imagen->delete(); // Eliminar la entrada de la base de datos
                }
            }

            $usuario->delete();
            DB::commit();
            Cache::flush();

            return redirect()->route('admin.usuarios.index')->with('success', 'Usuario eliminado exitosamente.');
        } catch (\Exception $e) {

            \Log::error('Error al eliminar usuario: ' . $e->getMessage());

            $data = [
                $message = 'No se pudo eliminar el usuario, debido a restricción de integridad.',
            ];

            return redirect()->route('admin.usuarios.index')->with('error', 'No se pudo eliminar el usuario, debido a restricción de integridad.');
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
