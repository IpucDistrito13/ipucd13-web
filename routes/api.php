<?php

use App\Http\Controllers\Api\LoginController;
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


Route::middleware(['auth:sanctum'])->group(function() {
    //Route::get('logout',[LoginController::class, 'logout']);
    //Importamos la version 1 (V1)

    require __DIR__ . '/api_v1.php';
});