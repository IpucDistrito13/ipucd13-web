<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Models\Galeria;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;

class GaleriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $userUUID = @auth()->user()->uuid;

            // Obtener los roles del usuario
            $dataTipoRol = DB::table('vista_roles_usuario')
                ->select('roles')
                ->where('uuid', $userUUID)
                ->first();

            // Asumimos que 'roles' es un campo que contiene una lista separada por comas
            $roles = explode(',', $dataTipoRol->roles);

            $rolId = 2;
            $data = User::ListarPorRol($rolId)->get();

            return datatables()::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) use ($roles) {
                    $buttons = '';

                    // Mostrar botones según los roles
                    if (in_array('Administrador', $roles) || in_array('Pastor', $roles)) {
                        $buttons .= '<a href="' . route("admin.galerias.privadoadmin", $row->uuid) . '" class="btn btn-primary btn-sm">Galería Privada</a>';
                        $buttons .= ' <a href="' . route("admin.galerias.generalAdmin", $row->uuid) . '" class="btn btn-secondary btn-sm">Galería General</a>';
                    } elseif (in_array('Pastor', $roles)) {
                        $buttons .= '<a href="' . route("admin.galerias.privadoadmin", $row->uuid) . '" class="btn btn-primary btn-sm">Galería Privada</a>';
                        $buttons .= ' <a href="' . route("admin.galerias.generalAdmin", $row->uuid) . '" class="btn btn-secondary btn-sm">Galería General</a>';
                    } elseif (in_array('Lider', $roles)) {
                        $buttons .= ' <a href="' . route("admin.galerias.generalAdmin", $row->uuid) . '" class="btn btn-secondary btn-sm">Ver galería</a>';
                    }

                    return $buttons;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.galerias.index');
    }


    public function list(Request $request)
    {
        if ($request->ajax()) {
            $rolId = 2;
            $data = User::ListarPorRol($rolId);

            return datatables()::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $buttons = ' <a href="' . route("admin.galerias.generalLider", $row->uuid) . '" class="btn btn-secondary btn-sm">Ver galeria</a>';
                    return $buttons;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.galerias.list');
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
    public function destroy(Galeria $galeria)
    {
        try {

            $url = $galeria->url;
            Storage::delete($url);
            $galeria->delete();

            $data = [
                'message' => 'Galería eliminada exitosamente.',
            ];
            return back()->with('success', $data['message']);

            //return redirect()->route('admin.galerias.privadoadmin', $galeria->user->uuid)->with('success', $data['message']);
        } catch (\Exception $e) {
        }
    }

    public function upload(Request $request)
    {
        // Validar la solicitud

        $usuario = $request->input('usuario');
        $tipo = $request->input('type');

        // Verificar si el archivo existe en la solicitud
        if ($request->hasFile('file')) {
            $file = $request->file('file');

            // Generar un nombre de archivo único
            $fileName = time() . '-' . $file->getClientOriginalName();

            $url = $file->storeAs('public/galeria/' . $usuario, $fileName);
            Storage::disk('digitalocean')->put('myfile.txt', $url);



            // Validar el tipo de galería y definir la ruta de almacenamiento
            //$url = $file->storeAs('public/galeria/' . $usuario, $fileName);

            if (!$url) {
                return response()->json(['error' => 'Error al almacenar el archivo.'], 500);
            }

            // Generar UUID
            $uuid = (string) Str::uuid();

            // Crear el array de datos para guardar en la base de datos
            $data = [
                'uuid' => $uuid,
                'url' => $url,
                'user_id' => $usuario,
                'galeriatipo_id' => $tipo,
                'createdby_id' => Auth::id(),
            ];

            // Crear el registro en la base de datos
            try {
                $galeria = Galeria::create($data);
                return response()->json(['message' => 'Se cargaron las fotos exitosamente.', 'uuid' => $uuid], 200);
            } catch (\Exception $e) {
                return response()->json(['error' => 'Error al guardar en la base de datos: ' . $e->getMessage()], 500);
            }
        } else {
            return response()->json(['error' => 'No se ha cargado ningún archivo.'], 400);
        }
    }


    public function privadoAdmin($uuid)
    {
        // 2 = GALERIA PRIVADO
        $tipoGeneral = 2;
        $usuario = User::where('uuid', $uuid)->first();
        $galerias = Galeria::galeriaTipoUsuario($tipoGeneral, $usuario->id)->paginate(8);

        // Formatear created_at a un formato de 12 horas
        foreach ($galerias as $galeria) {
            $galeria->formatted_created_at = $galeria->created_at->format('Y-m-d h:i:s A');
        }

        return view('admin.galerias.upload_privado', compact('usuario', 'galerias'));
    }

     //AGREGA GALERIA E IMAGENES, SE VISUALIZA EN TODOS LOS ROLES PASTORES
     public function generalLider($uuid)
     {
         // 1 = GALERIA GENERAL
         $tipoGeneral = 1;
         $usuario = User::where('uuid', $uuid)->first();
         $galerias = Galeria::galeriaTipoUsuario($tipoGeneral, $usuario->id)->paginate(8);
 
         // Formatear created_at a un formato de 12 horas
         foreach ($galerias as $galeria) {
             $galeria->formatted_created_at = $galeria->created_at->format('Y-m-d h:i:s A');
         }
 
         return view('admin.galerias.upload_general_lider', compact('usuario', 'galerias'));
     }

    

    //AGREGA GALERIA E IMAGENES, SE VISUALIZA EN TODOS LOS ROLES PASTORES Y ADMIN
    public function generalAdmin($uuid)
    {
        // 1 = GALERIA GENERAL
        $tipoGeneral = 1;
        $usuario = User::where('uuid', $uuid)->first();
        $galerias = Galeria::galeriaTipoUsuario($tipoGeneral, $usuario->id)->paginate(8);

        // Formatear created_at a un formato de 12 horas
        foreach ($galerias as $galeria) {
            $galeria->formatted_created_at = $galeria->created_at->format('Y-m-d h:i:s A');
        }

        return view('admin.galerias.upload_general', compact('usuario', 'galerias'));
    }

    /*

        public function privadoAdmin(User $usuario)
    {
        $galerias = Galeria::select('id', 'url', 'galeriatipo_id', 'created_at')
            ->where('galeriatipo_id', 2)
            ->where('user_id', $usuario->id)
            ->latest() // Ordenar las fotos por fecha de creación en orden descendente
            ->paginate(8);

        // Formatear created_at a un formato de 12 horas
        foreach ($galerias as $galeria) {
            $galeria->formatted_created_at = $galeria->created_at->format('Y-m-d h:i:s A');
        }

        return view('admin.galerias.privado', compact('usuario', 'galerias'));
    }
    */



    public function delete(Request $request)
    {
        try {
            $uuid = $request->input('uuid');

            // Buscar el archivo con el UUID proporcionado
            $file = Galeria::where('uuid', $uuid)->first();

            if ($file) {
                // Eliminar el archivo del almacenamiento
                Storage::delete($file->url);
                // Eliminar el registro de la base de datos
                $file->delete();

                return response()->json(['success' => true]);
            } else {
                return response()->json(['success' => false, 'message' => 'Archivo no encontrado.']);
            }
        } catch (\Exception $e) {
            Log::error('Error al eliminar el archivo: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Error al eliminar el archivo.']);
        }
    }

    /*
    public function pastores()
    {
        //$rol = 2; // 2 = Pastor
        $usuarios = User::with(['roles:id,name', 'congregacion'])->get();
        //return $usuarios;
        return view('admin.galerias.pastores', compact('usuarios'));
    }
    */


    public function lideres(Request $request)
    {

        if ($request->ajax()) {
            $rolId = 2;
            $data =  $usersWithRole = User::whereHas('roles', function ($query) use ($rolId) {
                $query->where('id', $rolId);
            })->with('roles')->get();
            //$data = User::select('id', 'nombre', 'apellidos', 'celular');

            return datatables()::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $galeriaGeneralUrl = route('admin.galerias.galeriaGeneral', ['uuid' => $row->uuid]);
                    $btn = '<a href="' . $galeriaGeneralUrl . '" class="edit btn btn-danger btn-sm">Galeria privado</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.galerias.lideres');


        //return view('admin.galerias.lideres');

    }


    public function galeriaPastores($uuid)
    {

        // Obtener todos los datos de la galería basados en el UUID
        $usuario = User::where('uuid', $uuid)->first();
        $galerias = Galeria::where('user_id', $usuario->id)->paginate(10); // Paginar los resultados, 10 registros por página

        return view('admin.galerias.test', compact('galerias', 'usuario'));


        // Verificar si se encontró la galería
        if (!$usuario) {
            // Manejar el caso donde no se encuentra la galería con el UUID proporcionado
            return response()->json(['error' => 'Galería no encontrada'], 404);
        }

        // Ahora puedes usar $galeria para acceder a todos los datos de la galería
        return response()->json($usuario);
    }


    public function galeriaGeneral($uuid)
    {

        // Obtener todos los datos de la galería basados en el UUID
        $usuario = User::where('uuid', $uuid)->first();
        $galerias = Galeria::where('user_id', $usuario->id)->paginate(10); // Paginar los resultados, 10 registros por página

        return view('admin.galerias.test', compact('galerias', 'usuario'));


        // Verificar si se encontró la galería
        if (!$usuario) {
            // Manejar el caso donde no se encuentra la galería con el UUID proporcionado
            return response()->json(['error' => 'Galería no encontrada'], 404);
        }

        // Ahora puedes usar $galeria para acceder a todos los datos de la galería
        return response()->json($usuario);
    }
}
