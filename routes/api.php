<?php

use Illuminate\Http\Request;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\AlmacenController;
use App\Http\Controllers\CamionController;
use App\Http\Controllers\LoteController;
use App\Http\Controllers\ProductoController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('usuarios', UsuarioController::class);
Route::apiResource('almacenes', AlmacenController::class);
Route::apiResource('camiones', CamionController::class);
Route::apiResource('lotes', LoteController::class);
Route::apiResource('productos', ProductoController::class);