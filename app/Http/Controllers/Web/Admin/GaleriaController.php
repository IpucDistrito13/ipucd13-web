<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Models\Galeria;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class GaleriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // Muestra lista de  Pastores con el estado Activo
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
                        $buttons .= ' <a href="' . route("admin.galerias.generalAdmin", $row->uuid) . '" class="btn btn-secondary btn-sm">Galería Publica</a>';
                    } elseif (in_array('Pastor', $roles)) {
                        $buttons .= '<a href="' . route("admin.galerias.privadoadmin", $row->uuid) . '" class="btn btn-primary btn-sm">Galería Privada</a>';
                        $buttons .= ' <a href="' . route("admin.galerias.generalAdmin", $row->uuid) . '" class="btn btn-secondary btn-sm">Galería Publica</a>';
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
     * Remove the specified resource from storage.
     */
    public function destroy(Galeria $galeria)
    {
        DB::beginTransaction();

        try {
            // Eliminar el archivo de la galería, si existe
            if ($galeria->url) {
                $this->deleteFile($galeria->url);
            }

            // Eliminar la galería
            $galeria->delete();

            Cache::flush();
            DB::commit();

            $data = [
                'message' => 'Galería eliminada exitosamente.',
            ];

            // Redireccionar con un mensaje de éxito
            return back()->with('success', $data['message']);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error destroy - Galeria: ' . $e->getMessage());

            // Manejo de excepciones si ocurre algún error
            return back()->with('error', 'No se pudo eliminar la galería.');
        }
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

    private function storeFile($file, $ubicacion, $fileName)
    {
        if (env('APP_ENV') === 'local') {
            return $file->storeAs('public/' . $ubicacion, $fileName);
        } else {
            return Storage::disk('s3')->put($ubicacion, $file);
        }
    }

    //Subir imagenes de galeria
    public function upload(Request $request)
    {
        DB::beginTransaction();

        try {
            // Validar la solicitud
            $validatedData = $request->validate([
                'file' => 'required|file',
                'usuario' => 'required',
                'type' => 'required|numeric',
            ]);

            // Obtener datos de la solicitud
            $usuario = $validatedData['usuario'];
            $tipo = $validatedData['type'];
            $file = $validatedData['file'];

            // Verificar si el archivo existe en la solicitud (ya validado)
            // Generar un nombre de archivo único
            $fileName = time() . '-' . $file->getClientOriginalName();

            // Determinar la ubicación de almacenamiento según el entorno
            $ubicacion = 'galeria/' . $usuario;
            //$ubicacion = (env('APP_ENV') === 'local') ? 'galeria/' . $usuario : 'galeria/' . $usuario;

            // Almacenar el archivo en el sistema de archivos utilizando storeFile
            $url = $this->storeFile($file, $ubicacion, $fileName);

            if (!$url) {
                DB::rollback();
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
            $galeria = Galeria::create($data);

            DB::commit();
            Cache::flush();

            return response()->json(['message' => 'Se cargaron las fotos exitosamente.', 'uuid' => $uuid], 200);
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Error upload - Publicación: ' . $e->getMessage());

            return response()->json(['error' => 'Error en la carga de fotos: ' . $e->getMessage()], 500);
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
    /*
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
    */



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
                Cache::flush();

                return response()->json(['success' => true]);
            } else {
                return response()->json(['success' => false, 'message' => 'Archivo no encontrado.']);
            }
        } catch (\Exception $e) {
            Log::error('Error destroy - Galeria: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Error al eliminar el archivo.']);
        }
    }

    
    public function lideres(Request $request)
    {

        if ($request->ajax()) {
            $rolId = 2;
            $data =  $usersWithRole = User::whereHas('roles', function ($query) use ($rolId) {
                $query->where('id', $rolId);
            })->with('roles')->get();

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
