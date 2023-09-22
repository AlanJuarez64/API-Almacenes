<?php

use Illuminate\Http\Request;
use App\Http\Controllers\AlmacenController;
use App\Http\Controllers\LoteController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ArticuloController;
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

Route::prefix('almacenes')->group(function (){
    Route::put('/{id}', [AlmacenController::class, 'ModificarDatos'])->middleware('cors'); 
    Route::post('/', [AlmacenController::class, 'Registrar'])->middleware('cors'); 
    Route::get('/', [AlmacenController::class, 'VerTodo'])->middleware('cors');
    Route::get('/{id}', [AlmacenController::class, 'Buscar'])->middleware('cors');
    Route::delete('/{id}', [AlmacenController::class, 'Eliminar'])->middleware('cors');
});


Route::prefix('productos')->group(function (){
    Route::put('/{id}', [ProductoController::class, 'ModificarDatos'])->middleware('cors');
    Route::post('/', [ProductoController::class, 'Registrar'])->middleware('cors'); 
    Route::get('/', [ProductoController::class, 'VerTodo'])->middleware('cors');
    Route::get('/{id}', [ProductoController::class, 'Buscar'])->middleware('cors');
    Route::delete('/{id}', [ProductoController::class, 'Eliminar'])->middleware('cors');
    Route::get('/{id}/lote', [ProductoController::class, 'BuscarLote'])->middleware('cors');
});

Route::prefix('lotes')->group(function (){
    Route::put('/{id}', [LoteController::class, 'ModificarDatos'])->middleware('cors');
    Route::post('/', [LoteController::class, 'Registrar'])->middleware('cors'); 
    Route::get('/', [LoteController::class, 'VerTodo'])->middleware('cors');
    Route::get('/{id}', [LoteController::class, 'Buscar'])->middleware('cors');
    Route::get('/{id}/almacen', [LoteController::class, 'BuscarAlmacen'])->middleware('cors'); 
    Route::delete('/{id}', [LoteController::class, 'Eliminar'])->middleware('cors');
});

Route::prefix('articulos')->group(function (){
    Route::get('/', [ArticuloController::class, 'VerTodo'])->middleware('cors');
    Route::get('/{id}', [ArticuloController::class, 'Buscar'])->middleware('cors');
    Route::get('/{id}/producto', [ArticuloController::class, 'VerProducto'])->middleware('cors');
    Route::put('/{id}', [ArticuloController::class, 'CambiarEstado'])->middleware('cors');
    Route::post('/', [ArticuloController::class, 'Registrar'])->middleware('cors');
    Route::delete('/{id}', [ArticuloController::class, 'Eliminar'])->middleware('cors');
});