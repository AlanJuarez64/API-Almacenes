<?php

namespace App\Http\Controllers;

use App\Models\Lote;
use Illuminate\Http\Request;

class LoteController extends Controller
{
    public function Registrar(Request $request)
    {
        $request->validate([
            'Nombre' => 'required|string|max:50',
            'Descripcion' => 'required|string|max:100',
            'Fecha_Hora_Estimada' => 'required|date',
            'Num_Serie' => 'required|integer',
        ]);

        $lote = Lote::create($request->all());

        return response()->json(['message' => 'Lote registrado con éxito.', 'lote' => $lote], 201);
    }

    public function Buscar(Request $request)
    {
        $id = $request->input('id');
        $lote = Lote::find($id);

        if (!$lote) {
            return response()->json(['error' => 'Lote no encontrado'], 404);
        }

        return response()->json(['lote' => $lote], 200);
    }

    public function BuscarAlmacen(Request $request)
    {
        $id = $request->input('id');
        $almacen = DB::table('almacenes')
            ->join('productos', 'almacenes.ID_Almacen', '=', 'productos.ID_Lote')
            ->where('productos.ID_Producto', $id)
            ->select('almacenes.*')
            ->first();

        if (!$almacen) {
            return response()->json(['error' => 'Almacén no encontrado para el lote dado'], 404);
        }

        return response()->json(['almacen' => $almacen], 200);
    }

    public function Eliminar(Request $request)
    {
        $id = $request->input('id');
        $lote = Lote::find($id);

        if (!$lote) {
            return response()->json(['error' => 'Lote no encontrado'], 404);
        }

        $lote->delete();

        return response()->json(['message' => 'Lote eliminado con éxito'], 200);
    }

    public function VerTodo()
    {
        $lotes = Lote::all();

        return response()->json(['lotes' => $lotes], 200);
    }


    public function ModificarDatos(Request $request, $id)
    {
        $request->validate([
            'Nombre' => 'required|string|max:50',
            'Descripcion' => 'required|string|max:100',
            'Fecha_Hora_Estimada' => 'required|date',
            'Num_Serie' => 'required|integer',
        ]);

        $lote = Lote::find($id);

        if (!$lote) {
            return response()->json(['error' => 'Lote no encontrado'], 404);
        }

        $lote->update($request->all());

        return response()->json(['message' => 'Lote modificado con éxito.', 'lote' => $lote], 200);
    }
 
}

