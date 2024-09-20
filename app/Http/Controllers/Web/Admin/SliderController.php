<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->middleware('can:admin.slider_app.index')->only(  'index');
        $this->middleware('can:admin.slider_app.create')->only(  'create', 'store', 'edit', 'update', 'destroy');
    }
    public function index()
    {
        $sliders = Slider::all();
        //return $sliders;
        return view('admin.sliders.index', compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.sliders.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        // Iniciar una transacción de base de datos
        DB::beginTransaction();

        try {

            // Crear la categoría con los datos proporcionados
            $slider = Slider::create([
                'titulo' => $request->nombre,
                'estado' => 'Activo',
            ]);

            // Verificar y almacenar el archivo de portada si se proporciona
            if ($request->hasFile('file')) {
                $fileSlider = $request->file('file');
                $ubicacionSlider = 'public/sliders/principal';
                $url = $this->storeFile($fileSlider, $ubicacionSlider);

                $slider->imagen()->create([
                    'url' => $url,
                    'imageable_type' => Slider::class,
                ]);
            }

            DB::commit();
            Cache::flush();

            // Redireccionar con un mensaje de éxito
            return redirect()
                ->route('admin.sliders.index')
                ->with('success', 'Slider creado exitosamente.');
        } catch (\Exception $e) {
            // Revertir la transacción en caso de error
            DB::rollBack();
            Log::error('Error store - Slider: ' . $e->getMessage());

            // Redireccionar con un mensaje de error y mantener los datos de entrada
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Error al crear Slider: ' . $e->getMessage());
        }
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
    public function edit(Slider $slider)
    {
        //return $slider;
        return view('admin.sliders.edit', compact('slider'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Slider $slider)
    {
        try {
            // Iniciar una transacción de base de datos
            DB::beginTransaction();

            $data = [
                'titulo' => $request->nombre,
                'estado' => 'Activo',
            ];

            $slider->update($data);

            // Verificar si se cargó un nuevo archivo
            if ($request->hasFile('file')) {
                $filePortada = $request->file('file');
                $ubicacionSlider = 'public/sliders/principal';
                $url = $this->storeFile($filePortada, $ubicacionSlider);

                if ($slider->imagen) {
                    Storage::delete($slider->imagen->url);

                    // Actualizar la relación de imagen con la nueva URL del archivo
                    $slider->imagen()->update([
                        'url' => $url,
                        'imageable_type' => Slider::class,
                    ]);
                } else {
                    // Si la slider no tiene una imagen, agregar una nueva imagen
                    $slider->imagen()->create([
                        'url' => $url,
                        'imageable_type' => Slider::class,
                    ]);
                }
            }

            // Commit si no hay errores
            DB::commit();

            // Eliminar datos almacenados en cache
            Cache::flush();

            // Redireccionar con un mensaje de éxito
            return redirect()
                ->route('admin.sliders.edit', $slider)
                ->with('success', 'Slider actualizado exitosamente.');
        } catch (\Exception $e) {
            // Revertir la transacción en caso de error
            DB::rollBack();
            Log::error('Error  update - Slider: ' . $e->getMessage());

            // Redireccionar con un mensaje de error
            return redirect()
                ->back()
                ->with('error', 'Error al actualizar el Slider: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Slider $slider)
    {
        DB::beginTransaction();

        try {
          

            // Eliminar todas las imágenes de portada asociadas a la slider, si las hay
            if ($slider->imagen()->exists()) {
                foreach ($slider->imagen()->get() as $imagen) {
                    $this->deleteFile($imagen->url);
                    $imagen->delete(); // Eliminar la entrada de la base de datos
                }
            }

            // Eliminar la serie
            $slider->delete();
            DB::commit();
            Cache::flush();

            // Redireccionar con un mensaje de éxito
            return redirect()
                ->route('admin.sliders.index')
                ->with('success', 'Slider eliminado exitosamente.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error  destroy - Slider: ' . $e->getMessage());


            // Redireccionar con un mensaje de error
            return redirect()
                ->back()
                ->with('error', 'No se pudo eliminar el slider, debido a restricción de integridad.');
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

    private function storeFile($file, $ubicacion)
    {
        if (env('APP_ENV') === 'local') {
            return Storage::put($ubicacion, $file);
        } else {
            return Storage::disk('s3')->put($ubicacion, $file);
        }
    }

}
