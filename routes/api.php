<?php

use App\Http\Middleware\Autenticacion;
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
    Route::put('/{id}', [AlmacenController::class, 'ModificarDatos'])->middleware(Autenticacion::class);
    Route::post('/', [AlmacenController::class, 'Registrar'])->middleware(Autenticacion::class);
    Route::get('/', [AlmacenController::class, 'VerTodo'])->middleware(Autenticacion::class);
    Route::get('/{id}', [AlmacenController::class, 'Buscar'])->middleware(Autenticacion::class);
    Route::delete('/{id}', [AlmacenController::class, 'Eliminar'])->middleware(Autenticacion::class);
});


Route::prefix('productos')->group(function (){
    Route::put('/{id}', [ProductoController::class, 'ModificarDatos'])->middleware(Autenticacion::class);
    Route::post('/', [ProductoController::class, 'Registrar'])->middleware(Autenticacion::class);
    Route::get('/', [ProductoController::class, 'VerTodo'])->middleware(Autenticacion::class);
    Route::get('/{id}', [ProductoController::class, 'Buscar'])->middleware(Autenticacion::class);
    Route::delete('/{id}', [ProductoController::class, 'Eliminar'])->middleware(Autenticacion::class);
    Route::get('/{id}/lote', [ProductoController::class, 'BuscarLote'])->middleware(Autenticacion::class);
});

Route::prefix('lotes')->group(function (){
    Route::put('/{id}', [LoteController::class, 'ModificarDatos'])->middleware(Autenticacion::class);
    Route::post('/', [LoteController::class, 'Registrar'])->middleware(Autenticacion::class);
    Route::get('/', [LoteController::class, 'VerTodo'])->middleware(Autenticacion::class);
    Route::get('/{id}', [LoteController::class, 'Buscar'])->middleware(Autenticacion::class);
    Route::get('/{id}/almacen', [LoteController::class, 'BuscarAlmacen'])->middleware(Autenticacion::class);
    Route::delete('/{id}', [LoteController::class, 'Eliminar'])->middleware(Autenticacion::class);
});

Route::prefix('articulos')->group(function (){
    Route::get('/', [ArticuloController::class, 'VerTodo'])->middleware(Autenticacion::class);
    Route::get('/{id}', [ArticuloController::class, 'Buscar'])->middleware(Autenticacion::class);
    Route::get('/{id}/producto', [ArticuloController::class, 'VerProducto'])->middleware(Autenticacion::class);
    Route::put('/{id}', [ArticuloController::class, 'CambiarEstado'])->middleware('cors');
    Route::post('/', [ArticuloController::class, 'Registrar'])->middleware(Autenticacion::class);
    Route::delete('/{id}', [ArticuloController::class, 'Eliminar'])->middleware(Autenticacion::class);
});