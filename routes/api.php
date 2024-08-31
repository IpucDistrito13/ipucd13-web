<?php

use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Web\Admin\ComiteController;
use Encore\Admin\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

/*
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
*/

/*
Route::middleware('auth:sanctum')->group(function () {
    Route::get('usuarios', [UserController::class, 'api']);
});

*/



Route::post('login', [LoginController::class, 'login']);

Route::prefix('v1')->group(function () {

    require __DIR__ . '/api_v1.php';
});


Route::prefix('v2')->group(function () {

    require __DIR__ . '/api_v2.php';
});



/*
Route::middleware('auth:sanctum')->get('/check-status', function () {
    return response()->json(['status' => 'Token is valid'], 200);
    
});
*/

use Laravel\Sanctum\NewAccessToken;

Route::middleware('auth:sanctum')->get('/check-status', function () {
    $user = Auth::user(); // Obtiene la información del usuario autenticado

    // Generar un nuevo token
    $newToken = $user->createToken('new-token-name')->plainTextToken;


    return response()->json([

        'id' => $user->id,
        'nombre' => $user->nombre,
        'apellidos' => $user->apellidos,
        'email' => $user->email,
        'isActivo' => true,
        'roles' => $user->roles->pluck('name'),
        'token' => $newToken, // Nuevo token generado

    ], 200);
});
