<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;


class LoginController extends Controller
{
    /*
    public function login(LoginRequest $request)
    {
        // Verificar si el correo electrónico existe en la base de datos
        $user = User::where('email', $request->email)->with('roles')->first();


        if (!$user) {
            // El correo electrónico no existe en la base de datos
            return response()->json([
                'message' => 'Correo electrónico no encontrado.'
            ], Response::HTTP_FOUND); //404
        }

        // Intentar autenticar al usuario
        if (Auth::attempt($request->only('email', 'password'))) {
            // Verificar si el estado del usuario es inactivo
            if ($user->estado === 'Inactivo') {
                // Si el usuario está inactivo, devolver un mensaje indicando el estado
                return response()->json([
                    'message' => 'Usuario inactivo. Por favor, contacte al administrador.'
                ], Response::HTTP_FORBIDDEN); //403
            }

            // Si la autenticación es exitosa y el usuario no está inactivo, continuar con la respuesta
            return response()->json([
                'data' => [
                    //'attributes' => [
                    'id' => $user->id,
                    'nombre' => $user->nombre,
                    'apellidos' => $user->apellidos,
                    'email' => $user->email,
                    //],

                    'relationships' => [
                        //'roles' => $user->roles->pluck('id')->implode(',')
                        'roles' => $user->roles->map(function ($role) {
                            return [
                                'id' => $role->id,
                                'type' => 'rol',
                                'nombre' => $role->name,
                            ];
                        })
                    ],
                    'token' => $user->createToken($request->device_name)->plainTextToken,
                ]
            ]);
        }

        // Si la autenticación falla debido a una contraseña incorrecta, devolver mensaje de contraseña incorrecta
        return response()->json([
            'message' => 'Contraseña incorrecta.'
        ], Response::HTTP_UNAUTHORIZED); //401
    }*/

    public function login(LoginRequest $request)
    {
        // Verificar si el correo electrónico existe en la base de datos
        $user = User::where('email', $request->email)->with('roles')->first();


        if (!$user) {
            // El correo electrónico no existe en la base de datos
            return response()->json([
                'message' => 'Correo electrónico no encontrado.'
            ], Response::HTTP_FORBIDDEN); //402
        }

        // Intentar autenticar al usuario
        if (Auth::attempt($request->only('email', 'password'))) {
            // Verificar si el estado del usuario es inactivo
            if ($user->estado === 'Inactivo') {
                // Si el usuario está inactivo, devolver un mensaje indicando el estado
                return response()->json([
                    'message' => 'Usuario inactivo. Por favor, contacte al administrador.'
                ], Response::HTTP_FORBIDDEN); //402
            }

            // Si la autenticación es exitosa y el usuario no está inactivo, continuar con la respuesta
            return response()->json([

                    'id' => $user->id,
                    'nombre' => $user->nombre,
                    'apellidos' => $user->apellidos,
                    'email' => $user->email,
                    'isActivo' => true,
                    'roles' => $user->roles->pluck('name'),
                    'token' => $user->createToken($request->device_name)->plainTextToken,
            ]);
        }

        // Si la autenticación falla debido a una contraseña incorrecta, devolver mensaje de contraseña incorrecta
        return response()->json([
            'message' => 'Contraseña incorrecta.'
        ], Response::HTTP_UNAUTHORIZED); //401
    }

    public function logout(Request $request)
    {
        // Revocar el token que se utilizó para autenticar la solicitud actual...
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Sesión cerrada exitosamente.']);
    }
}
