<?php

namespace App\Http\Controllers\Api\V2;

use App\Http\Controllers\Controller;
use App\Http\Resources\UsuariosResource;
use App\Http\Resources\V2\Resource\UsuarioCollection;
use App\Http\Resources\V2\Resource\UsuarioPerfilResource;
use App\Models\GenerarKeyApi;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function show($uuid)
    {
        // Busca al usuario por UUID
        $usuario = User::with('congregacion')->where('uuid', $uuid)->first();

        // Verifica si el usuario existe
        if (!$usuario) {
            return response()->json(['error' => 'Usuario no encontrado'], 404);
        }

        return new UsuarioPerfilResource($usuario);
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
    public function destroy(string $id)
    {
        //
    }

    public function getPerfilUsuario($uuid) {}

    public function getListUsuario(Request $request)
    {
        // Obtener la clave API del parámetro
        $apiKey = $request->query('api_key');

        $apiKeyExists = GenerarKeyApi::ValidarKeyApi($apiKey)->exists();

        // Si la clave API no existe, devolver un mensaje de error con el código de estado 401
        if (!$apiKeyExists) {
            return response()->json([
                'error' => 'No autorizado',
                'message' => 'La clave API proporcionada no es válida.'
            ], 401);
        }

        // Obtener los parámetros limit y offset de la URL
        $limit = $request->query('limit', 10);
        $offset = $request->query('offset', 0);

        $usuario = User::with('congregacion')->where('estado', 'Activo')
            ->orderBy('nombre', 'desc')
            ->offset($offset)
            ->limit($limit)
            ->get();
        return UsuarioPerfilResource::collection($usuario);
    }


    public function getListUsuarioPastor(Request $request)
    {
        // Obtener la clave API del parámetro
        $apiKey = $request->query('api_key');

        $apiKeyExists = GenerarKeyApi::ValidarKeyApi($apiKey)->exists();

        // Si la clave API no existe, devolver un mensaje de error con el código de estado 401
        if (!$apiKeyExists) {
            return response()->json([
                'error' => 'No autorizado',
                'message' => 'La clave API proporcionada no es válida.'
            ], 401);
        }

        // Obtener los parámetros limit y offset de la URL
        $limit = $request->query('limit', 10);
        $offset = $request->query('offset', 0);

        // Obtener el rol 'Pastor'
        $pastorRole = Role::where('name', 'Pastor')->first();

        // Filtrar usuarios con el rol 'Pastor' y estado 'Activo'
        $usuarios = User::with('congregacion')->whereHas('roles', function ($query) use ($pastorRole) {
            $query->where('role_id', $pastorRole->id);
        })->where('estado', 'Activo')
            ->orderBy('nombre', 'desc')
            ->offset($offset)
            ->limit($limit)
            ->get();

        return new UsuarioCollection($usuarios);
    }

    public function getListUsuarioLider(Request $request)
    {

        // Obtener la clave API del parámetro
        $apiKey = $request->query('api_key');

        $apiKeyExists = GenerarKeyApi::ValidarKeyApi($apiKey)->exists();

        // Si la clave API no existe, devolver un mensaje de error con el código de estado 401
        if (!$apiKeyExists) {
            return response()->json([
                'error' => 'No autorizado',
                'message' => 'La clave API proporcionada no es válida.'
            ], 401);
        }

        // Obtener los parámetros limit y offset de la URL
        $limit = $request->query('limit', 10);
        $offset = $request->query('offset', 0);

        // Obtener el rol 'Lider'
        $pastorRole = Role::where('name', 'Lider')->first();

        // Filtrar usuarios con el rol 'Pastor' y estado 'Activo'
        $usuarios = User::with('congregacion')->whereHas('roles', function ($query) use ($pastorRole) {
            $query->where('role_id', $pastorRole->id);
        })->where('estado', 'Activo')
            ->orderBy('nombre', 'desc')
            ->offset($offset)
            ->limit($limit)
            ->get();

        return new UsuarioCollection($usuarios);
    }
}
