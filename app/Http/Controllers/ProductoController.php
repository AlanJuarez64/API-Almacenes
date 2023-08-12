<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;

class ProductoController extends Controller
{
    public function Registrar(Request $request)
    {
        $request->validate([
            'Peso' => 'required|numeric|min:0',
            'Cantidad' => 'required|integer|min:1',
            'ID_Lote' => 'required|integer'
        ]);

        $producto = Producto::create($request->all());

        return response()->json(['message' => 'Producto registrado con éxito.', 'producto' => $producto], 201);
    }

    public function Buscar(Request $request)
    {
        $id = $request->input('id');
        $producto = Producto::find($id);

        if (!$producto) {
            return response()->json(['error' => 'Producto no encontrado'], 404);
        }

        return response()->json(['producto' => $producto], 200);
    }

    public function BuscarLote(Request $request)
    {
        $id = $request->input('id');
        $lote = DB::table('lotes')
            ->join('productos', 'lotes.ID_Lote', '=', 'productos.ID_Lote')
            ->where('productos.ID_Producto', $id)
            ->select('lotes.*')
            ->first();

        if (!$lote) {
            return response()->json(['error' => 'Lote no encontrado para el producto dado'], 404);
        }

        return response()->json(['lote' => $lote], 200);
    }

    public function Eliminar(Request $request)
    {
        $id = $request->input('id');
        $producto = Producto::find($id);

        if (!$producto) {
            return response()->json(['error' => 'Producto no encontrado'], 404);
        }

        $producto->delete();

        return response()->json(['message' => 'Producto eliminado con éxito'], 200);
    }

    public function VerTodo()
    {
        $productos = Producto::all();

        return response()->json(['productos' => $productos], 200);
    }

       public function ModificarDatos(Request $request)
    {
         
        $request->validate([
            'Peso' => 'required|numeric|min:0',
            'Cantidad' => 'required|integer|min:1',
            'ID_Lote' => 'required|integer',
        ]);

        $id = $request->input('ID_producto');
        $producto = Producto::find($id);

        if (!$producto) {
            return response()->json(['error' => 'Producto no encontrado'], 404);
        }

        $producto->update($request->all());

        return response()->json(['message' => 'Producto modificado con éxito.', 'producto' => $producto], 200);
    }
}
