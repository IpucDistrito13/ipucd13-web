<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Models\Solicitud;
use App\Models\SolicitudTipo;
use App\Models\User;
use Illuminate\Http\Client\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;


class SolicitudController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        //return 'Datatable solicitud';
        $userId = @auth()->user()->id;
        $solicitudes = Solicitud::SolicitudesListadoUser($userId)->limit(100)->get();

        return view('admin.solicitudes.index', [
            'solicitudes' => $solicitudes
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $solicitudTipo = SolicitudTipo::all();
        $uuid = time();
        $usuario = @auth()->user();
        $listSolicitudes = Solicitud::with('solicitudTipo')->SolicitudesListadoUser($usuario->id)
            ->orderBy('created_at', 'desc')  // Ordenar por created_at en orden descendente
            ->limit(100)                      // Limitar a los últimos 100 registros
            ->get();

        return view('admin.solicitudes.create', [

            'solicitudTipo' => $solicitudTipo,
            'uuid' => $uuid,
            'usuario' => $usuario,
            'listSolicitudes' => $listSolicitudes
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = [
            'uuid' => $request->uuid,
            'user_solicitud' => @auth()->user()->id,
            'solicitud_tipo_id' => $request->solicitud,
            'estado' => '0',
        ];

        $solicitud = Solicitud::create($data);

        $data = [
            'message' => 'Solicitud creada exitosamente.',
        ];

        return redirect()->route('admin.solicitudes.create')->with('success', $data['message']);
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
    public function edit(Solicitud $solicitud)
    {

        $solicitudTipo = SolicitudTipo::ListarCampos()->get();
        $solicitud = Solicitud::with('userSolicitud')->where('id', $solicitud->id)->first();
        $user = User::with('congregacion')->where('id', $solicitud->user_solicitud)->first();
        return view('admin.solicitudes.edit', [
            'solicitud' => $solicitud,
            'solicitudTipo' => $solicitudTipo,
            'user' => $user,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Solicitud $solicitud)
    {
        // Validación de los datos del formulario
        $validatedData = $request->validate([
            // Otras reglas de validación para otros campos si es necesario
            'file' => 'required|file|mimes:jpeg,png,pdf|max:2048', // Acepta JPEG, PNG y PDF, tamaño máximo de 2MB
        ]);

        // Verificar si se cargó un nuevo archivo
        if ($request->file('file')) {

            $url = Storage::put('public/solicitudes', $request->file('file'));


            // Si la categoría ya tiene una imagen, eliminar el archivo antiguo
            if ($solicitud->imagen) {
                Storage::delete($solicitud->url);

                $data = [
                    'id' => $request->id,
                    'estado' => '1',
                    'url' => $url,
                    'user_response' => @auth()->user()->id,
                ];

                $solicitud->update($data);

                /*
                // Actualizar la relación de imagen con la nueva URL del archivo
                $solicitud->imagen()->update([
                    'url' => $url,
                    'imageable_type' => Solicitud::class,
                ]);
                */
            } else {
                /* $solicitud->imagen()->create([
                    'url' => $url,
                    'imageable_type' => Solicitud::class,
                ]);
                */
                $data = [
                    'id' => $request->id,
                    'estado' => '1',
                    'url' => $url,
                    'user_response' => @auth()->user()->id,
                ];

                $solicitud->update($data);
            }
        }

        Cache::flush();


        // Redireccionar con un mensaje de éxito
        $data = [
            'message' => 'Solicitud ' . $solicitud->uuid . ' actualizada exitosamente.'
        ];
        return redirect()->route('admin.solicitudes.pendientes')->with('success', $data['message']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Solicitud $solicitud)
    {
        try {
            $solicitud->delete();

            $data = [
                'message' => 'Solicitud eliminada exitosamente.',
            ];

            return redirect()->route('admin.solicitudes.create')->with('success', $data['message']);
        } catch (\Exception $e) {
            $data = [
                'message' => 'No se pudo eliminar la solicitud, debido a restricción de integridad.',
            ];

            return redirect()->route('admin.solicitudes.create')->with('error', $data['message']);
        }
    }

    //VER LSITADO SOLICITUDES PENDIENTES
    public function pendientes()
    {
        $solicitudes = Solicitud::SolicitudesListadoPendientes()->get();

        return view('admin.solicitudes.pendientes', [
            'solicitudes' => $solicitudes
        ]);
    }

    public function respondidas()
    {
        $solicitudes = Solicitud::SolicitudesListadoRespondidas()->get();

        return view('admin.solicitudes.respondidas', [
            'solicitudes' => $solicitudes
        ]);
    }

    public function download($solicitudId)
    {
        $solicitud = Solicitud::where('uuid', $solicitudId)->first();


        if (!$solicitud->url) {
            abort(404, 'Solicitud not found');
        }

        // Obtén la extensión del archivo
        $extension = pathinfo($solicitud->url, PATHINFO_EXTENSION);

        $mimeType = '';
        switch (strtolower($extension)) {
            case 'pdf':
                $mimeType = 'application/pdf';
                break;
            case 'jpg':
            case 'jpeg':
                $mimeType = 'image/jpeg';
                break;
            case 'png':
                $mimeType = 'image/png';
                break;
        }

        // Define los encabezados personalizados
        $headers = [
            'Content-Type' => $mimeType,
            'Cache-Control' => 'no-store, no-cache, must-revalidate',
            'Pragma' => 'no-cache',
            'Expires' => '0',
        ];
        return Storage::download($solicitud->url, 'Solicitud_' . $solicitud->uuid . '.' . $extension, $headers);
    }
}
