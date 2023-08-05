<?php

use Illuminate\Http\Request;
use App\Http\Controllers\AlmacenController;
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

Route::prefix('almacenes')->group(function (){
    Route::put('/{id}', [AlmacenController::class, 'ModificarDatosDeAlmacen'])->middleware('cors'); 
    Route::post('/', [AlmacenController::class, 'RegistrarAlmacen'])->middleware('cors'); 
    Route::get('/', [AlmacenController::class, 'VerTodosLosAlmacenes'])->middleware('cors');
    Route::get('/{id]', [AlmacenController::class, 'BuscarAlmacen'])->middleware('cors');
    Route::delete('/{id}', [AlmacenController::class, 'EliminarAlmacen'])->middleware('cors');
});


Route::prefix('productos')->group(function (){
    Route::put('/{id}', [ProductoController::class, 'ModificarDatosDeProducto'])->middleware('cors');
    Route::post('/', [ProductoController::class, 'RegistrarProducto'])->middleware('cors'); 
    Route::get('/', [ProductoController::class, 'VerTodosLosProductos'])->middleware('cors');
    Route::get('/{id}', [ProductoController::class, 'BuscarProducto'])->middleware('cors');
    Route::delete('/{id}', [ProductoController::class, 'EliminaProducto'])->middleware('cors');
    Route::get('/lote/{id]', [ProductoController::class, 'BuscarLoteDeProducto'])->middleware('cors');
});

Route::prefix('lotes')->group(function (){
    Route::put('/{id}', [LoteController::class, 'ModificarDatosDeLote'])->middleware('cors');
    Route::post('/', [LoteController::class, 'RegistrarLote'])->middleware('cors'); 
    Route::get('/', [LoteController::class, 'VerTodosLosLotes'])->middleware('cors');
    Route::get('/{id}', [LoteController::class, 'BuscarLote'])->middleware('cors');
    Route::delete('/{id}', [LoteController::class, 'EliminLote'])->middleware('cors');
});

