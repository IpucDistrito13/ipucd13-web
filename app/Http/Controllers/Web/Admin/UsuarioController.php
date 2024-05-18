<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UsuarioRequest;
use App\Models\Congregacion;
use App\Models\Galeria;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Intervention\Image\Colors\Rgb\Channels\Red;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    protected static ?string $password;

    public function index()
    {

        return view('admin.usuarios.index');
    }

    public function list()
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

        //return $usuarios;
        return view('admin.usuarios.list', compact('usuarios'));
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


        $usuario = User::create([
            'name' => $request->nombre,
            'congregacion_id' => $request->congregacion,

            'uuid' => time(),
            'codigo' => $codigo,
            //'codigo' => $request->codigo,
            'nombre' => $request->nombre,
            'apellidos' => $request->apellidos,
            'celular' => $request->celular,
            'email' => $request->email,
            'profile_photo_path' => $url,
            'password' => static::$password ??= Hash::make('password'),
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
        // return  $congregaciones = Congregacion::all();
        return view('admin.usuarios.edit', [
            'usuario' => $usuario,
            'congregaciones' => $congregaciones,
            'roles' => $roles,
        ]);
    }


    public function updatePerfil(Request $request, User $usuario)
    {
        $request->validate([
            'email' => [
                'sometimes', // Solo validar si se proporciona el campo email
                'email',
                Rule::unique('users')->ignore($usuario->id),
            ],
            'password' => 'nullable|string|min:8',
            'password_confirmation' => 'nullable|string|min:8|same:password', // Validar que la repetición de la contraseña sea igual a la nueva contraseña

        ]);

        /////
        // return $request;

        $data = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        // Validar y actualizar el correo electrónico si se proporciona
        if ($request->has('email')) {
            $data['email'] = $request->input('email');
        }

        // Validar y actualizar la contraseña si se proporciona
        if ($request->has('password')) {
            $data['password'] = bcrypt($request->input('password'));
        }

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

        // Actualizar los datos del usuario
        $usuario->update($data);

        //Elimina datos cache
        Cache::flush();
        //Cache

        // Devolver una respuesta adecuada, por ejemplo, redireccionar al perfil del usuario
        return redirect()->route('admin.usuario.perfil')->with('success', 'Perfil actualizado exitosamente.');
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UsuarioRequest $request, User $usuario)
    {
        $usuario->roles()->sync($request->roles);
        // Actualizar los datos del usuario
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

        //Elimina datos cache
        Cache::flush();
        //Cache

        // Redireccionar con un mensaje de éxito
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
                'message' => 'Usuario eliminado exitosamente.',
            ];

            //Elimina datos cache
            Cache::flush();
            //Cache

            return redirect()->route('admin.usuarios.index')->with('success', $data['message']);
        } catch (\Exception $e) {
            // Agrega un mensaje de registro para depuración
            \Log::error('Error al eliminar usuario: ' . $e->getMessage());

            $data = [
                'message' => 'No se pudo eliminar el usuario, debido a restricción de integridad.',
            ];

            //Elimina datos cache
            Cache::flush();
            //Cache

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
        //return 'Test';
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