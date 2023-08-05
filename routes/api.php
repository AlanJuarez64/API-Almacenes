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
    Route::post('/editar', [AlmacenController::class, 'ModificarDatosDeAlmacen'])->middleware('cors'); 
    Route::post('/registro', [AlmacenController::class, 'RegistrarAlmacen'])->middleware('cors'); 
    Route::get('/ver-todos', [AlmacenController::class, 'VerTodosLosAlmacenes'])->middleware('cors');
    Route::post('/buscar', [AlmacenController::class, 'BuscarAlmacen'])->middleware('cors');
    Route::post('/borrar', [AlmacenController::class, 'EliminarAlmacen'])->middleware('cors');
});


Route::prefix('productos')->group(function (){
    Route::post('/editar', [ProductoController::class, 'ModificarDatosDeProducto'])->middleware('cors');
    Route::post('/registro', [ProductoController::class, 'RegistrarProducto'])->middleware('cors'); 
    Route::get('/ver-todos', [ProductoController::class, 'VerTodosLosProductos'])->middleware('cors');
    Route::post('/buscar', [ProductoController::class, 'BuscarProducto'])->middleware('cors');
    Route::post('/borrar', [ProductoController::class, 'EliminaProducto'])->middleware('cors');
    Route::post('/lote', [ProductoController::class, 'BuscarLoteDeProducto'])->middleware('cors');
});

Route::prefix('lotes')->group(function (){
    Route::post('/editar', [LoteController::class, 'ModificarDatosDeLote'])->middleware('cors');
    Route::post('/registro', [LoteController::class, 'RegistrarLote'])->middleware('cors'); 
    Route::get('/ver-todos', [LoteController::class, 'VerTodosLosLotes'])->middleware('cors');
    Route::post('/buscar', [LoteController::class, 'BuscarLote'])->middleware('cors');
    Route::post('/borrar', [LoteController::class, 'EliminLote'])->middleware('cors');
});

