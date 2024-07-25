<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LiderRequest;
use App\Models\Comite;
use App\Models\Lider;
use App\Models\LiderTipo;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;

class LiderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $lideres = Lider::all();
        return view('admin.lideres.index', [
            'lideres' => $lideres,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tipos = LiderTipo::selectList()->get();
        $comites = Comite::selectList()->get();
        $usuarios = User::all();

        return view('admin.lideres.create', [
            'tipos' => $tipos,
            'comites' => $comites,
            'usuarios' => $usuarios,
        ]);
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
    public function store(LiderRequest $request)
    {
        // Utilizamos DB::transaction() para iniciar una transacción en la base de datos
        DB::beginTransaction();

        try {
            $data = [
                'uuid' => time(),
                'lidertipo_id' => $request->tipo,
                'comite_id' => $request->comite,
                'usuario_id' => $request->usuario,
                'user_created' => auth()->id(),
                'estado' => 'Activo',
            ];

            // Creamos el registro dentro de la transacción
            $lider = Lider::create($data);

            // Verificar si se cargó un nuevo archivo
            if ($request->hasFile('file')) {
                $fileImagen = $request->file('file');

                // Verificar el tipo de archivo
                $ubicacion = 'public/comites/lideres';
                $url = $this->storeFile($fileImagen, $ubicacion);

                if ($url) {
                    $lider->imagen()->create([
                        'url' => $url,
                        'imageable_type' => Lider::class,
                    ]);
                }
            }

            // Commit para confirmar la transacción si todo va bien
            DB::commit();
            Cache::flush();

            return redirect()->route('admin.lideres.index')->with('success', 'Líder creado exitosamente.');
        } catch (\Exception $e) {
            // En caso de error, hacemos rollback para revertir cualquier cambio en la base de datos
            DB::rollback();
            Log::error('Error store - Lider: ' . $e->getMessage());

            // Aquí puedes manejar el error como desees, por ejemplo, redireccionar con un mensaje de error
            return redirect()->back()->withInput()->with(['error' => 'Ha ocurrido un error al crear el líder. 
            Por favor, intenta de nuevo más tarde.']);
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
    public function edit(Lider $lider)
    {
        $tipos = LiderTipo::selectList()->get();
        $comites = Comite::selectList()->get();
        $usuarios = User::all();
        return view('admin.lideres.edit', [
            'lider' => $lider,
            'tipos' => $tipos,
            'comites' => $comites,
            'usuarios' => $usuarios,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(LiderRequest $request, Lider $lider)
    {
        // Utilizamos DB::transaction() para iniciar una transacción en la base de datos
        DB::beginTransaction();

        try {
            $data = [
                'lidertipo_id' => $request->tipo,
                'comite_id' => $request->comite,
                'usuario_id' => $request->usuario,
            ];

            // Actualizamos el registro dentro de la transacción
            $lider->update($data);

            // Verificar si se cargó un nuevo archivo
            if ($request->hasFile('file')) {
                $fileImagen = $request->file('file');
                $ubicacion = 'public/comites/lideres';
                $url = $this->storeFile($fileImagen, $ubicacion);

                if ($lider->imagen) {
                    Storage::delete($lider->imagen->url);

                    // Actualizar la relación de imagen con la nueva URL del archivo
                    $lider->imagen()->update([
                        'url' => $url,
                        'imageable_type' => Lider::class,
                    ]);
                } else {
                    // Si el comité no tiene una imagen, agregar una nueva imagen
                    $lider->imagen()->create([
                        'url' => $url,
                        'imageable_type' => Lider::class,
                    ]);
                }
            }


            // Commit para confirmar la transacción si todo va bien
            DB::commit();
            Cache::flush();

            return redirect()->route('admin.lideres.index')->with('success', 'Líder actualizado exitosamente.');
        } catch (\Exception $e) {
            // En caso de error, hacemos rollback para revertir cualquier cambio en la base de datos
            DB::rollback();
            Log::error('Error  update - Lider: ' . $e->getMessage());

            // Aquí puedes manejar el error como desees, por ejemplo, redireccionar con un mensaje de error
            return redirect()->back()->withInput()->with(['error' => 'Ha ocurrido un error al actualizar el líder. 
            Por favor, intenta de nuevo más tarde.' . $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lider $lider)
    {
        // Utilizamos DB::transaction() para iniciar una transacción en la base de datos
        DB::beginTransaction();

        try {
            // Eliminamos el registro dentro de la transacción
            $lider->delete();

            // Commit para confirmar la transacción si todo va bien
            DB::commit();
            Cache::flush();

            return redirect()->route('admin.lideres.index')->with('success', 'Líder eliminado exitosamente.');
        } catch (\Exception $e) {
            // En caso de error, hacemos rollback para revertir cualquier cambio en la base de datos
            DB::rollback();
            Log::error('Error  destroy - Lider: ' . $e->getMessage());


            // Aquí puedes manejar el error como desees, por ejemplo, redireccionar con un mensaje de error
            return redirect()->back()->with(['error' => 'Ha ocurrido un error al eliminar el líder. 
            Por favor, intenta de nuevo más tarde.']);
        }
    }
}
